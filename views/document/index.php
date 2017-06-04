<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Project;
use app\models\Contractor;
use app\models\Contact;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index">

    <?php if ($relation !== null && $relation_id !== null) : ?>
        <p class="text-right">
            <?=
            Html::a('Добавить документ', ['create', 'relation' => $relation, 'relation_id' => $relation_id], ['class' => 'btn btn-success'])
            ?>
        </p>
    <?php endif; ?>
    <div class="panel">
        <div class="panel-body">
            <?php Pjax::begin(); ?>   
            <?=
            GridView::widget(array_merge(Yii::$app->params['GridView'], [
                'dataProvider' => $dataProvider,
                'columns' => [
                    'name',
                    'description',
                    [
                        'attribute' => 'document_type_id',
                        'value' => 'DocumentTypeName',
                    ],
                    // 'file',
                    ['class' => 'yii\grid\ActionColumn',
                        'headerOptions' => [
                            'width' => 75,
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($model->contractor_id) {
                                $class = Contractor::classname();
                            } elseif ($model->project_id) {
                                $class = Project::classname();
                            } else {
                                $class = Contact::classname();
                            }
                            $data = explode('\\', mb_strtolower($class::classname()));
                            $relation = array_pop($data);
                            $field = $relation . '_id';
                            return yii\helpers\Url::toRoute([$action, 'id' => $key, 'relation' => $relation, 'relation_id' => $model->$field]);
                        }
                    ],
                ],
            ]));
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
