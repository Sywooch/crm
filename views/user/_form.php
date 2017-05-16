<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

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
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">Данные пользователя</div>
                <div class="panel-body">
                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'patronimyc')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'post')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">Контактные данные</div>
                <div class="panel-body">

                    <?=
                    $form->field($model, 'email')->textInput(['maxlength' => true])->widget(MaskedInput::className(), [
                        'clientOptions' => [
                            'alias' => 'email'
                        ],
                    ])
                    ?>

                    <?=
                    $form->field($model, 'phone')->textInput(['maxlength' => true])->widget(MaskedInput::className(), [
                        'mask' => '+7 (999) 999-99-99',
                    ])
                    ?>

                    <?=
                    $form->field($model, 'mobilephone')->textInput(['maxlength' => true])->widget(MaskedInput::className(), [
                        'mask' => '+7 (999) 999-99-99',
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="text-right">
<?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
