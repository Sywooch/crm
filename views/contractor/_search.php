<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContractorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contractor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_opf') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'legal_country') ?>

    <?php // echo $form->field($model, 'legal_region') ?>

    <?php // echo $form->field($model, 'legal_city') ?>

    <?php // echo $form->field($model, 'legal_street') ?>

    <?php // echo $form->field($model, 'legal_house') ?>

    <?php // echo $form->field($model, 'legal_postcode') ?>

    <?php // echo $form->field($model, 'mailing_country') ?>

    <?php // echo $form->field($model, 'mailing_region') ?>

    <?php // echo $form->field($model, 'mailing_city') ?>

    <?php // echo $form->field($model, 'mailing_street') ?>

    <?php // echo $form->field($model, 'mailing_house') ?>

    <?php // echo $form->field($model, 'mailing_postcode') ?>

    <?php // echo $form->field($model, 'bank') ?>

    <?php // echo $form->field($model, 'bik') ?>

    <?php // echo $form->field($model, 'rs') ?>

    <?php // echo $form->field($model, 'ks') ?>

    <?php // echo $form->field($model, 'ogrn') ?>

    <?php // echo $form->field($model, 'kpp') ?>

    <?php // echo $form->field($model, 'inn') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
