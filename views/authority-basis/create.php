<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContractorOpf */

$this->title = 'Добавить основание полно';
$this->params['breadcrumbs'][] = ['label' => 'Основания полномочий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-opf-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
