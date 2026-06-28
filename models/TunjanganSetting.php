<?php

namespace app\models;

use yii\db\ActiveRecord;

class TunjanganSetting extends ActiveRecord
{
    public static function tableName()
    {
        return 'tunjangan_setting';
    }

    public function rules()
    {
        return [
            [['base_fare', 'berlaku_mulai', 'min_km', 'max_km'], 'required', 'message' => '{attribute} tidak boleh kosong.'],
            [['base_fare', 'min_km', 'max_km'], 'integer', 'message' => '{attribute} harus berupa angka.'],
            [['berlaku_mulai'], 'safe'],

            ['min_km', 'compare', 'compareValue' => 0, 'operator' => '>=', 'message' => 'Minimum harus 0 atau lebih besar.'],
            ['max_km', 'compare', 'compareAttribute' => 'min_km', 'operator' => '>', 'message' => 'Maksimum harus lebih besar dari Minimum.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'base_fare' => 'Tarif',
            'berlaku_mulai' => 'Berlaku Mulai',
            'min_km' => 'Minimum Kilometer',
            'max_km' => 'Maksimum Kilometer',
        ];
    }
}
