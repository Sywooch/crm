<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContractorOpf */

$this->title = 'Create Contractor Opf';
$this->params['breadcrumbs'][] = ['label' => 'Contractor Opfs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-opf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
