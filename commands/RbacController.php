<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Написано по мануалу
 * https://anart.ru/yii2/2016/04/11/yii2-rbac-ponyatno-o-slozhnom.html
 */
class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // удаляем старые данные
        $auth->removeAll();

        // создаем роли пользователей
        $administrator = $auth->createRole('administrator');
        $administrator->description = 'Администартор системы';
        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';

        // запись в БД
        $auth->add($administrator);
        $auth->add($manager);

        // Назначаем роль "Администратор" пользователю с ID 1
        $auth->assign($administrator, 1);
    }

}
