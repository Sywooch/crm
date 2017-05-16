<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $remember_me = false;

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REQUEST_TOKEN = 'request_token';

    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['email', 'password'],
            self::SCENARIO_REQUEST_TOKEN => ['email', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
            'remember_me' => 'Запомнить меня',
        ];
    }

    public function rules()
    {
        return [
            ['email', 'email'],
            [['email', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            ['email', 'required', 'on' => self::SCENARIO_REQUEST_TOKEN],
        ];
    }

    public function login()
    {
        $user = User::findIdentityByEmail($this->email);

        if ($user && $user->validatePassword($this->password)) {
            return Yii::$app->user->login($user, $this->remember_me ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    public function requestToken()
    {
        $user = User::findIdentityByEmail($this->email);

        if (!$user) {
            return false;
        }

        $user->generatePasswordResetToken();
        if (!$user->save(false)) {
            return false;
        }

        return Yii::$app->mailer->compose()
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                        ->setTo($this->email)
                        ->setSubject('Password reset for ' . Yii::$app->name)
                        ->setTextBody($user->password_reset_token)
                        ->send();
    }

}
