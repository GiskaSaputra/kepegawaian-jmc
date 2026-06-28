<?php

namespace app\models;

use yii\db\ActiveRecord;

class MasterData extends ActiveRecord
{
    public static function tableName()
    {
        return 'master_data';
    }
}
