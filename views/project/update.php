<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Изменить данные проекта ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="project-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
