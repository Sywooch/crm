<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use app\models\Contractor;
use app\models\Folder;
use app\models\DocumentType;
use kartik\file\FileInput;
use app\models\Document;

/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n<small>{hint}\n{error}</small>\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-3',
                    'offset' => 'col-sm-offset-3',
                    'wrapper' => 'col-sm-9',
                    'error' => '',
                    'hint' => '',
                ],
            ],
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
        ]);
?>

<div class="row">
    <div class="col-xs-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                Основные данные
            </div>
            <div class="panel-body">


                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'description')->textarea() ?>

                <?=
                $form->field($model, 'file')->widget(FileInput::classname(), [
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                    ]
                ])
                ?>

                <?php if (!$model->isNewRecord) : ?>
                    <?=
                    $form->field($model, 'filename', [
                        'enableLabel' => false,
                        'wrapperOptions' => [
                            'class' => 'col-xs-offset-3 col-xs-9', 
                        ],
                        'template' => '{label}{beginWrapper}<a href="' . Document::PATH_TO_FILE . $model->filename . '" target="_blank">{input}</a>{endWrapper}'
                    ])->staticControl()
                    ?>
                <?php endif; ?>
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
                $form->field($model, 'document_type_id')->widget(Select2::className(), [
                    'data' => DocumentType::getList(),
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => [
                        'placeholder' => 'Выберите тип документа ...',
                    ],
                ])
                ?>

                <?=
                $form->field($model, 'folder_id')->widget(Select2::className(), [
                    'data' => Folder::getList(),
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => [
                        'placeholder' => 'Выберите папку ...',
                    ],
                ])
                ?>
            </div>
        </div>
    </div>
</div>

<div class="text-right">
    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
