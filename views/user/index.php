<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Учетные записи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p class="text-right">
        <?= Html::a('Добавить учетную запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel">
        <div class="panel-body">
            <?=
            GridView::widget(array_merge(Yii::$app->params['GridView'], [
                'dataProvider' => $dataProvider,
                'summary' => '',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'lastname',
                    'firstname',
                    'patronymic',
                    'post',
                    'email:email',
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
        </div>
    </div>
</div>
