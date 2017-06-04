<?php

use yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */

$statuses = ArrayHelper::map(app\models\ProjectStatus::find()->orderBy('name')->all(), 'project_status_id', 'name');
$users = ArrayHelper::map(app\models\User::find()->orderBy('lastname')->all(), 'user_id', 'fullname');
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

                    <?= $form->field($model, 'description')->textarea(['maxlenght' => true]) ?>

                    <?=
                    $form->field($model, 'site')->textInput(['maxlength' => true])->widget(MaskedInput::classname(), [
                        'clientOptions' => [
                            'alias' => 'url',
                        ],
                    ])
                    ?>

                    <?=
                    $form->field($model, 'site_test')->textInput(['maxlength' => true])->widget(MaskedInput::classname(), [
                        'clientOptions' => [
                            'alias' => 'url',
                        ],
                    ])
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
                    $form->field($model, 'user_id')->widget(Select2::classname(), [
                        'data' => $users,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Выберите пользователя ...'],
                    ])
                    ?>

                    <?= $form->field($model, 'project_status_id')->radioList($statuses, ['prompt' => 'Статус проекта']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
