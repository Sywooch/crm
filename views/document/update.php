<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Document */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index', 'relation' => $relation, 'relation_id' => $relation_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->document_id], 'relation' => $relation, 'relation_id' => $relation_id];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="document-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
