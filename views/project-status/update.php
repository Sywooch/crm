<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectStatus */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Статусы проектов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="project-status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
