<?php
namespace app\controllers\api;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public $enableCsrfValidation = false;

    private $jwt_secret = 'RAHASIA_JMC_2026_SUPER_AMAN_32_KARAKTER_API';

    public function actionLogin()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $user = User::findOne(['username' => $username, 'disabled' => 0]);

        if ($user && Yii::$app->security->validatePassword($password, $user->password_hash)) {

            $payload = [
                'iss' => 'jmc-kepegawaian-api',
                'aud' => 'jmc-frontend',
                'iat' => time(),
                'exp' => time() + (60 * 60 * 2),
                'uid' => $user->id,
                'role' => $user->id_role
            ];

            $jwt = JWT::encode($payload, $this->jwt_secret, 'HS256');

            return [
                'status' => 'success',
                'token' => $jwt
            ];
        }

        Yii::$app->response->statusCode = 401;
        return [
            'status' => 'error',
            'message' => 'Username atau password salah.'
        ];
    }
}
