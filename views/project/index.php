<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\ProjectStatus;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <p class="text-right">
        <?= Html::a('Добавить проект', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'attribute' => 'description',
                        'filterInputOptions' => [
                            'class' => 'form-control input-sm',
                        ]
                    ],
                    [
                        'attribute' => 'project_status_id',
                        'value' => 'StatusName',
                        'filter' => ProjectStatus::getList(),
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
