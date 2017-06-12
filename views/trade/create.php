<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Добавить сделку';
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trade-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
