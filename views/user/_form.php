<?php
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;
use app\models\AuthItem;
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
        <div class="col-xs-7">
            <div class="panel panel-default">
                <div class="panel-heading">Данные пользователя</div>
                <div class="panel-body">
                    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'post')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-xs-5">
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
                    $form->field($model, 'mobilephone')->textInput(['maxlength' => true])->widget(MaskedInput::className(), [
                        'mask' => '+7 (999) 999-99-99',
                        'clientOptions' => [
                            'removeMaskOnSubmit' => true
                        ]
                    ])
                    ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Роли пользователя</div>
                <div class="panel-body">

                    <?=
                    $form->field($model, 'role', [
                        'template' => "{beginWrapper}{input}<small>{hint}{error}</small>{endWrapper}",
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-xs-12',
                            'error' => '',
                            'hint' => '',
                        ],
                    ])->widget(Select2::className(), [
                        'data' => AuthItem::getList(),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => [
                            'placeholder' => 'Выберите роли ...',
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
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
