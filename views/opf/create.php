<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContractorOpf */

$this->title = 'Добавить ОПФ';
$this->params['breadcrumbs'][] = ['label' => 'Организационно-правовые формы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contractor-opf-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
