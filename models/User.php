<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Pegawai;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $id_role
 * @property int|null $id_pegawai
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $nama
 * @property string|null $email
 * @property string|null $last_session
 * @property string|null $last_login
 * @property string|null $updated_at
 * @property string|null $created_at
 * @property int|null $disabled
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }


    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'disabled' => 0]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Mencari user berdasarkan username, email, atau nomor HP (dari tabel pegawai)
     */
    public static function findByUsernameOrEmailOrPhone($loginStr)
    {
        return static::find()
            ->joinWith('pegawai p')
            ->where(['user.disabled' => 0])
            ->andWhere([
                'or',
                ['user.username' => $loginStr],
                ['user.email' => $loginStr],
                ['p.nomor_hp' => $loginStr]
            ])
            ->one();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->last_session;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Memvalidasi password dengan hashing
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    public function getPegawai()
    {
        return $this->hasOne(Pegawai::class, ['id' => 'id_pegawai']);
    }
}
