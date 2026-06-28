<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class PegawaiController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'detail'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return in_array(Yii::$app->user->identity->id_role, [2, 3]);
                        }
                    ],
                    [
                        'actions' => ['tambah'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->id_role == 3;
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Anda tidak memiliki hak akses untuk membuka halaman ini.');
                }
            ],
        ];
    }

    public function actionIndex()
    {
        // PERBAIKAN: Gunakan Expression('NOW()') agar waktunya sinkron dengan Database
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Data Pegawai',
            'content' => 'Membuka halaman daftar pegawai (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();

        return $this->render('index');
    }

    public function actionTambah()
    {
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Data Pegawai',
            'content' => 'Membuka halaman form tambah/edit pegawai (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();

        return $this->render('tambah');
    }

    public function actionDetail($id = null)
    {
        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul Data Pegawai',
            'content' => 'Melihat detail data pegawai ID: ' . $id . ' (Read)',
            'created_by' => Yii::$app->user->id,
            'created_at' => new \yii\db\Expression('NOW()'),
            'ip' => Yii::$app->request->userIP,
            'url' => \yii\helpers\Url::current(),
        ])->execute();

        return $this->render('detail');
    }
}
