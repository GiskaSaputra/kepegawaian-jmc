<?php

declare(strict_types=1);

namespace app\controllers;

use Firebase\JWT\JWT;
use Yii;
use app\models\ContactForm;
use app\models\LoginForm;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\base\Security;
use yii\mail\MailerInterface;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly MailerInterface $mailer,
        private readonly Security $security,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'index', 'change-password', 'profile'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'change-password', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width' => 120,
                'height' => 50,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        $user = \app\models\User::findOne(Yii::$app->user->id);
        $role = \app\models\UserRole::findOne($user->id_role);
        $roleName = $role ? $role->nama_role : 'Superadmin';

        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Dashboard',
            'content' => 'Melihat halaman Dashboard',
            'created_by' => $user->id,
            'created_at' => date('Y-m-d H:i:s'),
            'ip' => Yii::$app->request->userIP,
            'url' => Yii::$app->request->url,
        ])->execute();

        $totalPegawai = 0;
        $totalKontrak = 0;
        $totalTetap   = 0;
        $totalMagang  = 0;
        $latestPegawai = [];

        if (strtolower($roleName) === 'manager hrd') {
            $totalPegawai  = \app\models\Pegawai::find()->where(['status' => 'Aktif'])->count();
            $totalKontrak  = \app\models\Pegawai::find()->where(['status' => 'Aktif', 'status_kontrak' => 'PKWT'])->count();
            $totalTetap    = \app\models\Pegawai::find()->where(['status' => 'Aktif', 'status_kontrak' => 'PKWTT'])->count();
            $totalMagang   = \app\models\Pegawai::find()->where(['status' => 'Aktif', 'status_kontrak' => 'Magang'])->count();
            $latestPegawai = \app\models\Pegawai::find()->orderBy(['id' => SORT_DESC])->limit(5)->all();
        }

        return $this->render('index', [
            'user' => $user,
            'roleName' => $roleName,
            'totalPegawai' => $totalPegawai,
            'totalKontrak' => $totalKontrak,
            'totalTetap' => $totalTetap,
            'totalMagang' => $totalMagang,
            'latestPegawai' => $latestPegawai,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $user = Yii::$app->user->identity;

            $payload = [
                'iss' => 'jmc-kepegawaian-api',
                'aud' => 'jmc-frontend',
                'iat' => time(),
                'exp' => time() + (60 * 60 * 2), // Berlaku 2 jam
                'uid' => $user->id,
                'role' => $user->id_role
            ];
            $jwt = JWT::encode($payload, 'RAHASIA_JMC_2026_SUPER_AMAN_32_KARAKTER_API', 'HS256');
            Yii::$app->session->set('jwt_token_sync', $jwt);

            Yii::$app->db->createCommand()->insert('activities', [
                'title' => 'Login System',
                'content' => 'Pengguna ' . $user->username . ' berhasil login.',
                'ip' => Yii::$app->request->userIP,
                'ua' => Yii::$app->request->userAgent,
                'url' => \yii\helpers\Url::current(),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $user->id,
            ])->execute();
            // ------------------------

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        $userId = Yii::$app->user->id;
        $username = Yii::$app->user->identity->username;

        if (!Yii::$app->user->isGuest) {
            Yii::$app->db->createCommand()->insert('activities', [
                'title' => 'Logout System',
                'content' => 'Pengguna ' . $username . ' melakukan logout.',
                'ip' => Yii::$app->request->userIP,
                'ua' => Yii::$app->request->userAgent,
                'url' => \yii\helpers\Url::current(),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $userId,
            ])->execute();
        }

        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact(): Response|string
    {
        $model = new ContactForm();

        $contact = $model->load($this->request->post()) && $model->contact(
            $this->mailer,
            Yii::$app->params['adminEmail'],
            Yii::$app->params['senderEmail'],
            Yii::$app->params['senderName'],
        );

        if ($contact) {
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            return $this->refresh();
        }

        return $this->render('contact', ['model' => $model]);
    }

    public function actionAbout(): string
    {
        return $this->render('about');
    }

    public function actionProfile()
    {
        $user = \app\models\User::findOne(Yii::$app->user->id);
        $role = \app\models\UserRole::findOne($user->id_role);
        $roleName = $role ? $role->nama_role : 'Administrator';

        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'My Profile',
            'content' => 'Melihat halaman profil pribadi',
            'created_by' => $user->id,
            'created_at' => date('Y-m-d H:i:s'),
            'ip' => Yii::$app->request->userIP,
            'url' => Yii::$app->request->url,
        ])->execute();

        return $this->render('profile', [
            'user' => $user,
            'roleName' => $roleName,
        ]);
    }

    public function actionChangePassword()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        if (Yii::$app->request->isPost) {
            $recent = Yii::$app->request->post('recent_password');
            $new = Yii::$app->request->post('new_password');
            $confirm = Yii::$app->request->post('confirm_password');
            $user = Yii::$app->user->identity;

            if (!Yii::$app->security->validatePassword($recent, $user->password_hash)) {
                Yii::$app->session->setFlash('error', 'Password saat ini (Recent Password) salah.');
            }
            elseif ($new !== $confirm) {
                Yii::$app->session->setFlash('error', 'Password baru dan konfirmasi password tidak cocok.');
            }
            elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}$/', $new)) {
                Yii::$app->session->setFlash('error', 'Password baru harus minimal 8 karakter, tidak ada spasi, minimal 1 huruf besar, 1 huruf kecil, dan 1 karakter khusus.');
            }
            else {
                $userModel = \app\models\User::findOne($user->id);
                $userModel->password_hash = Yii::$app->security->generatePasswordHash($new);
                if ($userModel->save(false)) {

                    Yii::$app->db->createCommand()->insert('activities', [
                        'title' => 'My Profile (Change Password)',
                        'content' => 'Pengguna ' . $user->username . ' berhasil merubah password.',
                        'created_by' => $user->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'ip' => Yii::$app->request->userIP,
                        'url' => Yii::$app->request->url,
                    ])->execute();

                    Yii::$app->session->setFlash('success', 'Password berhasil diubah. Silakan gunakan password baru ini pada login berikutnya.');
                    return $this->refresh();
                }
            }
        }

        return $this->render('change-password');
    }
}
