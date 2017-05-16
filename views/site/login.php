<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\alert\AlertBlock;

$this->title = 'Вход';
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

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'remember_me')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary form-control', 'name' => 'login-button']) ?>
    </div>
    <p class="text-center"><?= Html::a('Забыли пароль?', ['site/request-token']); ?></p>
</div>

<?php ActiveForm::end(); ?>

</div>
