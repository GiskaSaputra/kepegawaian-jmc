<?php
namespace app\models;

use yii\db\ActiveRecord;
use app\models\TunjanganDetail;

class TunjanganBulan extends ActiveRecord
{
    public static function tableName()
    {
        return 'tunjangan_bulan';
    }

    public function getDetails()
    {
        return $this->hasMany(TunjanganDetail::class, ['id_tunjangan_bulan' => 'id']);
    }
}
