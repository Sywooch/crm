<?php
/* @var $this yii\web\View */
/* @var $model app\models\user */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Смена пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{beginWrapper}\n{input}\n<small>{hint}\n{error}</small>\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-3',
                            'offset' => 'col-sm-offset-3',
                            'wrapper' => 'col-sm-6',
                            'error' => '',
                            'hint' => '',
                        ],
                    ],
        ]);
        ?>


        <?= $form->field($model, 'old_password')->passwordInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_confirm')->passwordInput() ?>
    </div>
</div>

<div class="text-right">
    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
