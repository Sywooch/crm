<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">
    <div class="row">
        <div class="col-xs-6">
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
                            <?= Html::activeLabel($model, 'site', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', Html::a($model->site, $model->site, ['target' => '_blank']), Yii::$app->params['html']['form-control-static']) ?>

                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'site_test', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', Html::a($model->site, $model->site_test, ['target' => '_blank']), Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Параметры
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'id_user', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->user->getFullname(), Yii::$app->params['html']['form-control-static']) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'id_status', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->status->name, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="text-right">
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

</div>
