<?php
namespace app\models;

use yii\db\ActiveRecord;

class RolePermission extends ActiveRecord
{
    public static function tableName()
    {
        return 'role_permission';
    }
}
