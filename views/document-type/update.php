<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Типы документов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="document-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
