<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'ITIS CRM',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => [
                    ['label' => 'Проекты', 'url' => ['/project/']],
                    ['label' => 'Контрагенты', 'url' => ['/contractor/']],
                    ['label' => 'Контакты', 'url' => ['/contact/']],
                    ['label' => 'Документы', 'url' => ['/document/']],
                    ['label' => 'Учетные записи', 'url' => ['/user/']],
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Настройки',
                        'items' => [
                            ['label' => 'Статусы проектов', 'url' => ['/project-status/']],
                            ['label' => 'Типы документов', 'url' => ['/document-type/']],
                            ['label' => 'Папки', 'url' => ['/folder/']],
                            ['label' => 'ОПФ', 'url' => ['/opf/']],
                        ]
                    ],
                    !Yii::$app->user->isGuest ? (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    'Выход', ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                            ) : ''
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <div class="page-header">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Anton Kazarinov <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
