<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contractor */

$this->title = 'Изменение данных: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Контрагенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="contractor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
