<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->getFullname();
$this->params['breadcrumbs'][] = ['label' => 'Учетные записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->getFullname(true);
?>
<div class="user-view">
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'post',
            'email:email',
            'phone',
            'mobilephone',
        ],
    ])
    ?>

    <p class="text-right">
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
</div>
