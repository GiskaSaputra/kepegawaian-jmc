<?php
namespace app\models;

use yii\db\ActiveRecord;

class Activities extends ActiveRecord
{
    public static function tableName()
    {
        return 'activities';
    }
}
