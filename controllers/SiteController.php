<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\User;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->login()) {
                return $this->goBack();
            } else {
                Yii::$app->session->setFlash('error', 'Не правильно указан E-mail или пароль');
            }
        }

        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionRequestToken()
    {
        $this->layout = 'login';
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_REQUEST_TOKEN]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->requestToken()) {
                Yii::$app->session->setFlash('success', 'На Ваш адрес отправлено письмо с дальнейшими инструкциями');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'E-mail не найден или не удалось отправить письмо');
            }
        }

        return $this->render('requestToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'login';

        $user = User::findIdentityByAccessToken($token);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Invalid Token');
            return $this->goHome();
        }

        $user->scenario = User::SCENARIO_RESET_PASSWORD;
        if ($user->load(Yii::$app->request->post()) && $user->validate() && $user->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $user,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
