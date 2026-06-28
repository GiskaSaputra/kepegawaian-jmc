<?php
namespace app\models;

use yii\db\ActiveRecord;
use app\models\Pegawai;

class TunjanganDetail extends ActiveRecord
{
    public static function tableName()
    {
        return 'tunjangan_detail';
    }

    public function getPegawai()
    {
        return $this->hasOne(Pegawai::class, ['id' => 'id_pegawai']);
    }
}
