<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\alert\AlertBlock;

$this->title = 'Смена пароля';
?>
<div class="site-login">

    <header class="text-center">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?=
    AlertBlock::widget([
        'delay' => 0,
    ])
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Сохранить пароль', ['class' => 'btn btn-primary form-control']) ?>
        </div>
    </div>
    
    <p class="text-center"><?= Html::a('Вернуться к форме входа', ['site/login']); ?></p>

    <?php ActiveForm::end(); ?>

</div>
