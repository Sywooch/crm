<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\alert\AlertBlock;

$this->title = 'Сброс пароля';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= AlertBlock::widget([
        'delay' => 0,
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_confirm')->passwordInput() ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Сохранить пароль', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
