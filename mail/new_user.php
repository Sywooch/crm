<?php 
use yii\helpers\Url;
use yii\helpers\Html;

?>
<p>Здравствуйте, <?= $firstname ?> <?= $patronimyc ?>!</p>
<p>Для Вас в системе CRM «ИТИС» была создана новая учетная запись. Для входа перейдите по этой <?= Html::a('ссылке', Url::to(['site/reset-password', 'token' => $token]))?></p>