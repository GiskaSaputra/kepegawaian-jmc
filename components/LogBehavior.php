<?php
namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class LogBehavior extends Behavior
{
    /**
     * Mendaftarkan event/trigger kapan log harus dicatat
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function afterInsert($event)
    {
        $this->logActivity('Create');
    }
    public function afterUpdate($event)
    {
        $this->logActivity('Update');
    }
    public function afterDelete($event)
    {
        $this->logActivity('Delete');
    }

    protected function logActivity($action)
    {
        if (Yii::$app instanceof \yii\console\Application) {
            return;
        }

        $tableName = $this->owner->tableName();


        $userId = Yii::$app->user->id ?? null;


        if (!$userId && Yii::$app->request->headers->has('X-Api-User-Id')) {
            $userId = Yii::$app->request->headers->get('X-Api-User-Id');
        }

        Yii::$app->db->createCommand()->insert('activities', [
            'title' => 'Modul ' . ucfirst($tableName),
            'content' => "Sistem mencatat aksi {$action} pada tabel {$tableName} (ID Record: " . $this->owner->getPrimaryKey() . ")",
            'ip' => Yii::$app->request->userIP ?? '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $userId
        ])->execute();
    }
}
