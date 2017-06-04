<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProjectStatus */

$this->title = 'Добавить статус';
$this->params['breadcrumbs'][] = ['label' => 'Статусы проектов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-status-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
