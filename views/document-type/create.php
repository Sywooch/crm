<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DocumentType */

$this->title = 'Добавить тип документов';
$this->params['breadcrumbs'][] = ['label' => 'Типы документов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
