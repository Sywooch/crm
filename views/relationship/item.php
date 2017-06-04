<?php
/* @var $model app\models\Relationship */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= $model->title ?>
        <span class="pull-right"><small><?= $model->created_at ?></small></span>
    </div>
    <div class="panel-body">
        <?= $model->description ?>
    </div>
</div>
