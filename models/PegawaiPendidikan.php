<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class PegawaiPendidikan extends ActiveRecord
{
    public static function tableName()
    {
        return 'pegawai_pendidikan';
    }

    public function rules()
    {
        return [
            [['id_pegawai', 'tingkat', 'nama_sekolah', 'tahun_lulus'], 'required'],
            [['id_pegawai'], 'integer'],
            [['tahun_lulus'], 'safe'],
            [['tingkat'], 'string', 'max' => 50],
            [['nama_sekolah'], 'string', 'max' => 150],

            // Relasi ke Pegawai
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::class, 'targetAttribute' => ['id_pegawai' => 'id']],
        ];
    }

    public function getPegawai()
    {
        return $this->hasOne(Pegawai::class, ['id' => 'id_pegawai']);
    }
}
