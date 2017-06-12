<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TradeStatus */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Статусы сделок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
