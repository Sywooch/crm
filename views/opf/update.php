<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContractorOpf */

$this->title = 'Update Contractor Opf: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Contractor Opfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contractor-opf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
