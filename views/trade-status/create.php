<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TradeStatus */

$this->title = 'Добавить статус';
$this->params['breadcrumbs'][] = ['label' => 'Статусы сделок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
