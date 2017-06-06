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
        html::a('Взаимоотношения <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ', ['relationship/index', 'relation' => 'contact', 'relation_id' => $model->contact_id], [
            'class' => 'btn btn-default btn-sm'
        ])
        ?>

        <?=
        html::a('Документы <i class="fa fa-file" aria-hidden="true"></i> ', ['document/index', 'relation' => 'contact', 'relation_id' => $model->contact_id], [
            'class' => 'btn btn-default btn-sm'
        ])
        ?>
    </p>

    <div class="row">
        <div class="col-xs-7">
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
                            <?= Html::activeLabel($model, 'patronymic', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->patronymic, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'post', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->post, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'authority_basis_id', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', ($model->authorityBasis !== null ? $model->authorityBasis->name : ''), Yii::$app->params['html']['form-control-static']) ?>

                        </div>
                        <div class="form-group">    
                            <?= Html::activeLabel($model, 'contractor_id', Yii::$app->params['html']['control-label']); ?>
                            <?= Html::tag('p', $model->contractor->name, Yii::$app->params['html']['form-control-static']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-5">
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
        <?= Html::a('Изменить', ['update', 'id' => $model->contact_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->contact_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данные?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

</div>
