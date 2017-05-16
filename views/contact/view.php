<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title = $model->getFullName(true);
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

    <p class="menu">
        <?=
        html::a('Взаимоотношения <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ', ['contact/' . $model->id . '/relationships'], [
            'class' => 'btn btn-default btn-sm'
        ])
        ?>

        <?=
        html::a('Документы <i class="fa fa-file" aria-hidden="true"></i> ', ['/document', 'contact' => $model->id], [
            'class' => 'btn btn-default btn-sm'
        ])
        ?>
    </p>

    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Основные данные
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'lastname', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->lastname, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'firstname', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->firstname, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'patronimyc', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->patronimyc, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'post', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->post, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'id_contractor', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->contractor->name, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Контакты
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'email', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::mailto($model->email, $model->email, Yii::$app->params['html']['form-control-static']) ?>
                        </div>

                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'phone', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->phone, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Дополнительно
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'description', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->description, Yii::$app->params['html']['form-control-static']) ?>
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
                'confirm' => 'Вы действительно хотите удалить данные?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

</div>
