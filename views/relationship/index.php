<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Взаимоотношения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relationship-index">

    <p class="text-right">
        <?= Html::a('Добавить запись', ['create', 'relation' => $relation, 'relation_id' => $relation_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    

    <?php foreach ($dataProvider->models as $model) : ?>
        <?=
        $this->render('item', [
            'model' => $model
        ])
        ?>
    <?php endforeach; ?>

    <?=
    LinkPager::widget([
        'pagination' => $dataProvider->pagination
    ])
    ?>

<?php Pjax::end(); ?></div>
