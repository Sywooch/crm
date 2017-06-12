<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Trade */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->trade_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="trade-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
