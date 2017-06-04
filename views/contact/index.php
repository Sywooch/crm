<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <p class="text-right">
        <?= Html::a('Добавить контакт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel">
        <div class="panel-body">

            <?=
            GridView::widget(array_merge(Yii::$app->params['GridView'], [
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'contractor_id',
                        'value' => 'ContractorName'
                    ],
                    'lastname',
                    'firstname',
                    'patronymic',
                    'email:email',
                    'phone',
                    ['class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'width' => 75,
                        ],
                    ],
                ],
            ]));
            ?>
        </div>
    </div>
</div>
