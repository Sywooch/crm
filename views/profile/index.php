<?php
/* @var $this yii\web\View */
/* @var $model app\models\user */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Профиль пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n<small>{hint}\n{error}</small>\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]);
?>
<div class="row">
    <div class="col-xs-7">
        <div class="panel panel-default">
            <div class="panel-heading">Данные пользователя</div>
            <div class="panel-body">
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-xs-5">
        <div class="panel panel-default">
            <div class="panel-heading">Контактные данные</div>
            <div class="panel-body">

                <?=
                $form->field($model, 'mobilephone')->textInput(['maxlength' => true])->widget(MaskedInput::className(), [
                    'mask' => '+7 (999) 999-99-99',
                    'clientOptions' => [
                        'removeMaskOnSubmit' => true
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>

<div class="text-right">
    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>


