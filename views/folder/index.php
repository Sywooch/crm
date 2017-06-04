<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Папки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-index">

    <p class="text-right">
        <?= Html::a('Добавить папку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel">
        <div class="panel-body">
            <?php Pjax::begin(); ?>    
            <?=
            GridView::widget(array_merge(Yii::$app->params['GridView'], [
                'dataProvider' => $dataProvider,
                'columns' => [
                    'name',
                    [
                        'class' => 'yii\grid\ActionColumn',
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
