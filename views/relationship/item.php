<?php
/* @var $model app\models\Relationship */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= $model->title ?>
        <span class="pull-right"><?= $model->datetime ?></span>
    </div>
    <div class="panel-body">
        <?= $model->description ?>
    </div>
</div>
