<?php

use yii\helpers\Html;
use app\models\Document;

/* @var $this yii\web\View */
/* @var $model app\models\Document */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index', 'relation' => $relation, 'relation_id' => $relation_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-view">

    <div class="row">
        <div class="col-xs-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Основные данные
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'name', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->name, Yii::$app->params['html']['form-control-static']) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'description', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->description, Yii::$app->params['html']['form-control-static']) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'filename', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', Html::a($model->filename, '/' . Document::PATH_TO_FILE . $model->filename, ['target' => '_blank']), Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Параметры
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <?= Html::activeLabel($model, 'document_type_id', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->documentType->name, Yii::$app->params['html']['form-control-static']) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'folder_id', Yii::$app->params['html']['control-label']); ?>
                            <?php if ($model->folder) : ?>
                                <?= Html::tag('p', $model->folder->name, Yii::$app->params['html']['form-control-static']) ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="text-right">
        <?= Html::a('Изменить', ['update', 'id' => $model->document_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->document_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
</div>
