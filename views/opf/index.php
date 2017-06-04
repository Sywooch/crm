<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractorOpfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Организационно-правовые формы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-opf-index">

    <p class="text-right">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel">
        <div class="panel-body">
            <?php Pjax::begin(); ?>   
            <?=
            GridView::widget(array_merge(Yii::$app->params['GridView'], [
                'dataProvider' => $dataProvider,
                'columns' => [
                    'short',
                    'name',
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'headerOptions' => [
                            'width' => 45,
                        ],
                    ],
                ],
            ]));
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
