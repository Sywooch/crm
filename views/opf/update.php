<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractorOpf */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Организационно-правовые формы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="contractor-opf-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
