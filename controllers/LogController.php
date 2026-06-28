<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\web\ForbiddenHttpException;

class LogController extends Controller
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
                    throw new ForbiddenHttpException('Akses Ditolak! Halaman Log Aktifitas hanya diperuntukkan bagi Superadmin.');
                }
            ],
        ];
    }

    public function actionIndex()
    {
        $logs = (new Query())
            ->select(['activities.*', 'user.username'])
            ->from('activities')
            ->leftJoin('user', 'user.id = activities.created_by')
            ->orderBy(['activities.created_at' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'logs' => $logs,
        ]);
    }
}
