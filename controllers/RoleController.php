<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\UserRole;

class RoleController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
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
                    throw new \yii\web\ForbiddenHttpException('Akses Ditolak! Halaman ini khusus untuk Superadmin.');
                }
            ],
        ];
    }

    /**
     * Halaman List Role
     */
    public function actionIndex()
    {
        // --- KODE PEREKAM LOG ---
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Kelola Role',
            'content' => 'Membuka halaman daftar role pengguna (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();
        // ------------------------

        $roles = UserRole::find()->all();

        return $this->render('index', [
            'roles' => $roles
        ]);
    }

    /**
     * Halaman Detail Hak Akses
     */
    public function actionHakAkses($id)
    {
        $role = UserRole::findOne($id);

        if (!$role) {
            throw new \yii\web\NotFoundHttpException("Role tidak ditemukan.");
        }

        // --- KODE PEREKAM LOG ---
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Kelola Role',
            'content' => 'Melihat detail hak akses dari Role: ' . $role->nama_role . ' (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();
        // ------------------------

        $permissions = [
            [
                'modul' => 'Login/Logout',
                'canAksesMenu' => true, 'canCreateMenu' => false,
                'read' => 'No', 'update' => 'No', 'delete' => 'No',
            ],
            [
                'modul' => 'Kelola Role',
                'canAksesMenu' => $role->id == 1, // Hanya Superadmin
                'canCreateMenu' => false,
                'read' => $role->id == 1 ? 'All' : 'No',
                'update' => 'No', 'delete' => 'No',
            ],
            [
                'modul' => 'Kelola User',
                'canAksesMenu' => $role->id == 1,
                'canCreateMenu' => $role->id == 1,
                'read' => $role->id == 1 ? 'All' : 'No',
                'update' => $role->id == 1 ? 'All' : 'No',
                'delete' => $role->id == 1 ? 'All' : 'No',
            ],
            [
                'modul' => 'Modul Data Pegawai',
                'canAksesMenu' => $role->id == 2 || $role->id == 3, // HRD Manager & Admin
                'canCreateMenu' => $role->id == 3,
                'read' => $role->id == 2 || $role->id == 3 ? 'All' : 'No',
                'update' => $role->id == 3 ? 'All' : 'No',
                'delete' => $role->id == 3 ? 'All' : 'No',
            ],
        ];

        return $this->render('hak-akses', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }
}
