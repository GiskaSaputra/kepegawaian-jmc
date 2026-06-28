<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserRole extends ActiveRecord
{
    /**
     * Menghubungkan model ini dengan tabel "user_role" di database
     */
    public static function tableName()
    {
        return 'user_role';
    }
}
