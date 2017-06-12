<?php

use yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use kartik\money\MaskMoney;
use kartik\date\DatePicker;
use app\models\Contractor;
use app\models\TradeStatus;

/* @var $this yii\web\View */
/* @var $model app\models\Trade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php
    $form = ActiveForm::begin(Yii::$app->params['ActiveForm']);
    ?>
    <div class="row">
        <div class="col-xs-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Основные данные
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?=
                    $form->field($model, 'contractor_id')->widget(Select2::classname(), [
                        'data' => Contractor::getList(),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Выберите контрагента ...'],
                    ])
                    ?>

                    <?=
                    $form->field($model, 'price')->widget(MaskMoney::classname())
                    ?>

                    <?=
                    $form->field($model, 'start')->widget(DatePicker::classname(), [
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'endDate' => '',
                        ]
                    ]);
                    ?>
                        
                    <?=
                    $form->field($model, 'end')->widget(DatePicker::classname(), [
                        'type' => DatePicker::TYPE_INPUT,
                         'pluginOptions' => [
                            'startDate' => '',
                        ]
                    ]);
                    ?>

                </div>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Параметры
                </div>
                <div class="panel-body">
                    <?=
                    $form->field($model, 'trade_status_id')->widget(Select2::classname(), [
                        'data' => TradeStatus::getList(),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Выберите статус сделки ...'],
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
