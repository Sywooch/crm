<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Contractor;
use app\models\TradeStatus;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TradeSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сделки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <p class="text-right">
        <?= Html::a('Добавить сделку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>   
    <div class="panel">
        <div class="panel-body">
            <?php Pjax::begin() ?>
            <?=
            GridView::widget(array_merge(Yii::$app->params['GridView'], [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'filterInputOptions' => [
                            'class' => 'form-control input-sm',
                        ]
                    ],
                    [
                        'attribute' => 'contractor_id',
                        'value' => 'ContractorName',
                        'filter' => Contractor::getList(),
                        'filterInputOptions' => [
                            'class' => 'form-control input-sm',
                        ]
                    ],
                    'start:date',
                    'end:date',
                    'price',
                    [
                        'attribute' => 'trade_status_id',
                        'value' => 'StatusName',
                        'filter' => TradeStatus::getList(),
                        'filterInputOptions' => [
                            'class' => 'form-control input-sm',
                        ]
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'width' => 75,
                        ],
                    ],
                ],
            ]));
            ?>
            <?php Pjax::end() ?>
        </div>
    </div>

</div>
