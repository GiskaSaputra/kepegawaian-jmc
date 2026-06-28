<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;



class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $verifyCode;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password', 'verifyCode'], 'required', 'message' => '{attribute} tidak boleh kosong.'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha', 'message' => 'Kode Captcha tidak sesuai.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username / Email / No. HP',
            'password' => 'Password',
            'rememberMe' => 'Remember me',
            'verifyCode' => 'Kode Captcha',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Username atau password salah.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; 
            return Yii::$app->user->login($this->getUser(), $duration);
        }
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsernameOrEmailOrPhone($this->username);
        }
        return $this->_user;
    }
}
