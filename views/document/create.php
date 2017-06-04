<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Document */

$this->title = 'Добавить документ';
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index', 'relation' => $relation, 'relation_id' => $relation_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
