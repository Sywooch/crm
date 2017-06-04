<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class ProfileController extends Controller
{

    public function actionIndex()
    {
        $model = Yii::$app->user->getIdentity();
        $model->scenario = User::SCENARIO_PROFILE;
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Данные профиля успешно изменены');
                return $this->redirect('/profile');
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось изменить данные профиля');
            }
        }        

        return $this->render('index', [
                    'model' => $model
        ]);
    }
    
    public function actionChangePassword() {
        $model = Yii::$app->user->getIdentity();
        $model->scenario = User::SCENARIO_CHANGE_PASSWORD;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->resetPassword()) {
                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
                return $this->redirect('/site');
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось изменить пароль');
            }
        }        

        return $this->render('change-password', [
                    'model' => $model
        ]);
    }
}
