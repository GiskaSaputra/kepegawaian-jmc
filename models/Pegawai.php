<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\MasterData;
use app\models\MasterWilayah;

class Pegawai extends ActiveRecord
{
    public static function tableName()
    {
        return 'pegawai';
    }

    public function rules()
    {
        return [
            // Field wajib (Required)
            [['nip', 'nama_pegawai', 'jenis_kelamin', 'email', 'nomor_hp', 'tempat_lahir', 'tanggal_lahir', 'status_kawin', 'tanggal_masuk', 'id_jabatan', 'id_departemen', 'status', 'status_kontrak'], 'required', 'message' => '{attribute} tidak boleh kosong.'],

            // Aturan tipe data numerik
            [['id_kecamatan', 'id_jabatan', 'id_departemen', 'usia'], 'integer'],

            // Aturan Jarak Rumah & Jumlah Anak (Maksimal 2 digit sesuai spesifikasi)
            [['jarak_rumah_kantor', 'jumlah_anak'], 'integer', 'max' => 99, 'message' => '{attribute} maksimal 2 digit angka.'],

            // Aturan panjang NIP (Hanya angka, minimal 8 digit)
            ['nip', 'match', 'pattern' => '/^[0-9]{8,}$/', 'message' => 'NIP harus berupa angka dan minimal 8 karakter.'],
            ['nip', 'unique', 'message' => 'NIP ini sudah terdaftar.'],

            // Aturan Nama (Hanya huruf, angka, spasi, dan petik atas)
            ['nama_pegawai', 'match', 'pattern' => '/^[a-zA-Z0-9\s\']+$/', 'message' => 'Nama hanya boleh berisi huruf, angka, spasi, dan tanda petik atas.'],

            // Aturan Email & Nomor HP (Format Internasional)
            ['email', 'email', 'message' => 'Format email tidak valid.'],
            ['nomor_hp', 'match', 'pattern' => '/^\+62[0-9]{8,13}$/', 'message' => 'Nomor HP harus menggunakan format internasional (contoh: +62822...).'],

            // Aturan Enum & Date
            [['jenis_kelamin', 'status_kawin', 'status', 'status_kontrak'], 'string'],
            [['tanggal_lahir', 'tanggal_masuk'], 'safe'],
            [['alamat_lengkap'], 'string'],

            // Aturan Foto Pegawai (Format PNG/JPEG/JPG)
            [['foto_pegawai'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'message' => 'Format foto harus PNG, JPG, atau JPEG.'],
        ];
    }

    public function behaviors()
    {
        return [
            \app\components\LogBehavior::class,
        ];
    }

    // --- RELASI DATABASE ---

    public function getJabatan()
    {
        return $this->hasOne(MasterData::class, ['id' => 'id_jabatan'])->andWhere(['tipe' => 'jabatan']);
    }

    public function getDepartemen()
    {
        return $this->hasOne(MasterData::class, ['id' => 'id_departemen'])->andWhere(['tipe' => 'departemen']);
    }

    public function getKecamatan()
    {
        return $this->hasOne(MasterWilayah::class, ['id' => 'id_kecamatan']);
    }

    // Relasi baru ke tabel Pendidikan (One-to-Many)
    public function getPendidikan()
    {
        return $this->hasMany(PegawaiPendidikan::class, ['id_pegawai' => 'id']);
    }

}
