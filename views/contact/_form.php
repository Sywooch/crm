<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use app\models\Contractor;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

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
                <div class="panel-heading">
                    Основные данные
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'patronimyc')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'post')->textInput(['maxlength' => true]) ?>

                    <?=
                    $form->field($model, 'id_contractor')->widget(select2::classname(), [
                        'data' => Contractor::getList(),
                        'language' => 'ru',
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => [
                            'placeholder' => 'Выберите контрагента ...',
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Контакты
                </div>
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
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Дополнительно
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'description')->textarea() ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
