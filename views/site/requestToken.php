<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Cброс пароля';
?>
<div class="site-login">
    <header class="text-center">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary form-control', 'name' => 'request-button']) ?>
        </div>
    </div>

    <p class="text-center"><?= Html::a('Назад', ['site/login']); ?></p>

    <?php ActiveForm::end(); ?>

</div>
