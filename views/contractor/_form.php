<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use app\models\Opf;
use app\models\Project;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Contractor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contractor-form">

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
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                Основные данные
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <?=
                        $form->field($model, 'id_opf')->widget(Select2::classname(), [
                            'data' => Opf::getList(),
                            'language' => 'ru',
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => [
                                'placeholder' => 'Организационно-правовая форма ...',
                            ],
                        ])
                        ?>

                        <?=
                        $form->field($model, 'projects')->widget(Select2::classname(), [
                            'data' => Project::getList(),
                            'language' => 'ru',
                            'showToggleAll' => false,
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => [
                                'placeholder' => 'Выберите проект ...',
                                'multiple' => true
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">


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
                        $form->field($model, 'fax')->textInput(['maxlength' => true])->widget(MaskedInput::className(), [
                            'mask' => '+7 (999) 999-99-99',
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" href="#address">
                Адреса <span class="more-less pull-right glyphicon glyphicon-chevron-down"></span>
            </div>
            <div class="panel-body collapse" id="address">
                <div class="row">
                    <div class="col-xs-6">
                        <h3>Юридический адрес</h3>
                        <?= $form->field($model, 'legal_country')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'legal_region')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'legal_city')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'legal_street')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'legal_house')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'legal_postcode')->textInput() ?>
                    </div>
                    <div class="col-xs-6">                           
                        <h3>Почтовый адрес</h3>
                        <?= $form->field($model, 'mailing_country')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'mailing_region')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'mailing_city')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'mailing_street')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'mailing_house')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'mailing_postcode')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" data-toggle="collapse" href="#requisites">
                Реквизиты <span class="more-less pull-right glyphicon glyphicon-chevron-down"></span>
            </div>
            <div class="panel-body collapse" id="requisites">
                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'bank')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'bik')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'rs')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'ks')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-xs-6">

                        <?= $form->field($model, 'ogrn')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'kpp')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
