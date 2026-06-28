<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Pegawai;
use app\models\UserRole;
use app\models\MasterData;

class UserController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->id_role == 1;
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('Akses Ditolak! Halaman Manajemen User hanya untuk Superadmin.');
                }
            ],
        ];
    }

    public function actionIndex()
    {

        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Kelola User',
            'content' => 'Melihat daftar pengguna (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => date('Y-m-d H:i:s'),
            'ip' => Yii::$app->request->userIP,
            'url' => Yii::$app->request->url,
        ])->execute();


        $users = User::find()->with(['pegawai.jabatan', 'pegawai.departemen'])->all();

        $roles = UserRole::find()->all();
        $jabatans = MasterData::find()->where(['tipe' => 'jabatan'])->all();
        $departemens = MasterData::find()->where(['tipe' => 'departemen'])->all();

        return $this->render('index', [
            'users' => $users,
            'roles' => $roles,
            'jabatans' => $jabatans,
            'departemens' => $departemens
        ]);
    }

    public function actionCariPegawai($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (strlen($q) < 2) {
            return [];
        }

        $pegawais = Pegawai::find()
            ->with(['jabatan', 'departemen'])
            ->where(['like', 'nama_pegawai', $q])
            ->andWhere(['not in', 'id', User::find()->select('id_pegawai')->where(['is not', 'id_pegawai', null])])
            ->limit(10)
            ->all();

        $result = [];
        foreach ($pegawais as $p) {
            $result[] = [
                'id' => $p->id,
                'text' => $p->nama_pegawai,
                'jabatan' => $p->jabatan ? $p->jabatan->nama : '-',
                'departemen' => $p->departemen ? $p->departemen->nama : '-'
            ];
        }
        return $result;
    }

    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            if (User::findOne(['username' => strtolower(trim($post['username']))])) {
                Yii::$app->session->setFlash('error', 'Username sudah terdaftar! Gunakan username lain.');
                return $this->redirect(['index']);
            }

            $user = new User();

            $user->id_pegawai = !empty($post['id_pegawai']) ? $post['id_pegawai'] : null;
            $user->username = strtolower(trim($post['username']));
            $user->password_hash = Yii::$app->security->generatePasswordHash($post['password']);
            $user->id_role = $post['id_role'];
            $user->disabled = isset($post['status']) && $post['status'] == 'on' ? 0 : 1;

            if ($user->save()) {


                Yii::$app->db->createCommand()->insert('activities', [
                    'title' => 'Modul Kelola User',
                    'content' => 'Menambah user baru (Create) dengan username: ' . $user->username,
                    'created_by' => Yii::$app->user->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'ip' => Yii::$app->request->userIP,
                    'url' => Yii::$app->request->url,
                ])->execute();

                Yii::$app->session->setFlash('success', 'Data User berhasil ditambahkan.');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan user.');
            }
            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->request->isPost) {
            $user = User::findOne($id);
            if (!$user) {
                Yii::$app->session->setFlash('error', 'Data User tidak ditemukan.');
                return $this->redirect(['index']);
            }

            $post = Yii::$app->request->post();
            $usernameBaru = strtolower(trim($post['username']));

            $existingUser = User::findOne(['username' => $usernameBaru]);
            if ($existingUser && $existingUser->id !== $user->id) {
                Yii::$app->session->setFlash('error', 'Gagal Update: Username tersebut sudah dipakai oleh pengguna lain!');
                return $this->redirect(['index']);
            }


            if (!empty($post['id_pegawai'])) {
                $user->id_pegawai = $post['id_pegawai'];
            }

            $user->username = $usernameBaru;
            $user->id_role = $post['id_role'];
            $user->disabled = isset($post['status']) && $post['status'] == 'on' ? 0 : 1;

            if (!empty($post['password'])) {
                $user->password_hash = Yii::$app->security->generatePasswordHash($post['password']);
            }

            if ($user->save(false)) {


            Yii::$app->db->createCommand()->insert('activities', [
                    'title' => 'Modul Kelola User',
                    'content' => 'Memperbarui data user (Update) ID: ' . $user->id . ' - ' . $user->username,
                    'created_by' => Yii::$app->user->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'ip' => Yii::$app->request->userIP,
                    'url' => Yii::$app->request->url,
                ])->execute();


                Yii::$app->session->setFlash('success', 'Data User berhasil diperbarui.');
            } else {
                Yii::$app->session->setFlash('error', 'Gagal memperbarui data user.');
            }
            return $this->redirect(['index']);
        }
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);
        if ($user) {
            if ($user->id == Yii::$app->user->id) {
                Yii::$app->session->setFlash('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
            } else {
                $usernameDeleted = $user->username;
                $user->delete();


                Yii::$app->db->createCommand()->insert('activities', [
                    'title' => 'Modul Kelola User',
                    'content' => 'Menghapus data user (Delete) dengan username: ' . $usernameDeleted,
                    'created_by' => Yii::$app->user->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'ip' => Yii::$app->request->userIP,
                    'url' => Yii::$app->request->url,
                ])->execute();

                Yii::$app->session->setFlash('success', 'Data User berhasil dihapus.');
            }
        }
        return $this->redirect(['index']);
    }
}
