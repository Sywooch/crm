<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Folder */

$this->title = 'Добавить папку';
$this->params['breadcrumbs'][] = ['label' => 'Папки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
