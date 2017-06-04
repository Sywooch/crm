<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статусы проектов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-status-index">

    <p class="text-right">
        <?= Html::a('Добавить статус', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel">
        <div class="panel-body">
            <?=
            GridView::widget(array_merge(Yii::$app->params['GridView'], [
                'dataProvider' => $dataProvider,
                'columns' => [
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
        </div>
    </div>
</div>
