<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contractor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Контрагенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-view">

    <p class="menu">
        <?=
        html::a('Взаимоотношения <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ', ['relationship/index', 'relation' => 'contractor', 'relation_id' => $model->contractor_id], [
            'class' => 'btn btn-default btn-sm'
        ])
        ?>

        <?=
        html::a('Документы <i class="fa fa-file" aria-hidden="true"></i> ', ['document/index', 'relation' => 'contractor', 'relation_id' => $model->contractor_id], [
            'class' => 'btn btn-default btn-sm'
        ])
        ?>
    </p>

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                Основные данные
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-horizontal">
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'name', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->name, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'opf_id', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->opf->name, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'projects', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', implode(',', $model->projects), Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-horizontal">
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'email', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::mailto($model->email, $model->email, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'phone', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->phone, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'fax', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->fax, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                        </div>
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
                        <div class="form-horizontal">
                            <h3>Юридический адрес</h3>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'legal_country', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->legal_country, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'legal_region', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->legal_region, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'legal_city', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->legal_city, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'legal_street', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->legal_street, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'legal_house', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->legal_house, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'legal_postcode', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->legal_postcode, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">              

                        <div class="form-horizontal">
                            <h3>Почтовый адрес</h3>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'mailing_country', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->mailing_country, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'mailing_region', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->mailing_region, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'mailing_city', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->mailing_city, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'mailing_street', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->mailing_street, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'mailing_house', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->mailing_house, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'mailing_postcode', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->mailing_postcode, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                        </div>
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
                        <div class="form-horizontal">
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'bank', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->bank, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'bik', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->bik, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'rs', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->rs, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'ks', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->ks, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-horizontal">
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'ogrn', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->ogrn, Yii::$app->params['html']['form-control-static']) ?>
                            </div>

                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'kpp', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->kpp, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                            <div class="form-group">    
                                <?= Html::activeLabel($model, 'inn', Yii::$app->params['html']['control-label']); ?>
                                <?= Html::tag('p', $model->inn, Yii::$app->params['html']['form-control-static']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="text-right">
        <?= Html::a('Изменить', ['update', 'id' => $model->contractor_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->contractor_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить данные контрагента?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

</div>
