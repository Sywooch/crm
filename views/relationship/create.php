<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Relationship */

$this->title = 'Добавить запись';
$this->params['breadcrumbs'][] = ['label' => 'Взаимоотношения', 'url' => ['index', 'relation' => $relation, 'relation_id' => $relation_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relationship-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
