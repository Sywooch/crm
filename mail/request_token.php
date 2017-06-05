<?php 
use yii\helpers\Url;
use yii\helpers\Html;

?>
<p>Здравствуйте, <?= $firstname ?> <?= $patronimyc ?>!</p>
<p>Для восстановления пароля перейдите по этой <?= Html::a('ссылке', Url::to(['site/reset-password', 'token' => $token], true))?></p>