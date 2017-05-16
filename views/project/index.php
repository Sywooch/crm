<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
    <?=
    GridView::widget(array_merge(Yii::$app->params['GridView'], [
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description',
            [
                'attribute' => 'id_status',
                'value' => 'StatusName'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => [
                    'width' => 75,
                ],
            ],
        ],
    ]));
    ?>
    
</div>
