<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trade */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

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
                            <?= Html::activeLabel($model, 'contractor_id', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->contractor->name, Yii::$app->params['html']['form-control-static']) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'price', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->price . ' руб.', Yii::$app->params['html']['form-control-static']); ?>
                        </div>

                        <div class="form-group">
                            <?= Html::activeLabel($model, 'start', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->start, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                        <div class="form-group">
                            <?= Html::activeLabel($model, 'end', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->end, Yii::$app->params['html']['form-control-static']) ?>
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
                            <?= Html::activeLabel($model, 'trade_status_id', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->tradeStatus->name, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="text-right">
        <?= Html::a('Изменить', ['update', 'id' => $model->trade_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->trade_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

</div>
