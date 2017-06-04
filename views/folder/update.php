<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Folder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Папки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="folder-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
