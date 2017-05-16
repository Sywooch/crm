<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Relationship */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Relationships', 'url' => ['index', 'relation' => $relation, 'relation_id' => $relation_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relationship-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id, 'relation' => $relation, 'relation_id' => $relation_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->id, 'relation' => $relation, 'relation_id' => $relation_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_autor',
            'title',
            'description',
            'datetime:datetime',
        ],
    ])
    ?>

</div>
