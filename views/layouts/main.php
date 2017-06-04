<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SBAdminAsset;
use kartik\alert\AlertBlock;

SBAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div id="wrapper" class="fill">
            <?php
            NavBar::begin([
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-default',
                ],
                'containerOptions' => [
                    'id' => 'navbar-ex1-collapse'
                ],
                'innerContainerOptions' => [
                    'class' => 'container-fluid'
                ],
            ]);
            ?>
            <?=
            Nav::widget([
                'options' => ['class' => 'nav navbar-nav side-nav'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => '<i class="fa fa-dashboard"></i> Панель приборов',
                        'url' => ['/'],
                        'active' => Yii::$app->controller->id == 'site',
                    ],
                    [
                        'label' => '<i class="fa fa-product-hunt"></i> Проекты',
                        'url' => ['/project/'],
                        'active' => Yii::$app->controller->id == 'project',
                        'visible' => Yii::$app->user->can('manager'),
                    ],
                    [
                        'label' => '<i class="fa fa-vcard"></i> Контрагенты',
                        'url' => ['/contractor/'],
                        'active' => Yii::$app->controller->id == 'contractor',
                        'visible' => Yii::$app->user->can('manager'),
                    ],
                    [
                        'label' => '<i class="fa fa-address-book"></i> Контакты',
                        'url' => ['/contact/'],
                        'active' => Yii::$app->controller->id == 'contact',
                        'visible' => Yii::$app->user->can('manager'),
                    
                    ],
                    [
                        'label' => '<i class="fa fa-folder-open"></i> Документы',
                        'url' => ['/document/'],
                        'active' => Yii::$app->controller->id == 'document',
                        'visible' => Yii::$app->user->can('manager'),
                    
                    ],
                ],
            ]);
            ?>
            <?=
            Nav::widget([
                'options' => [
                    'class' => 'navbar-nav navbar-right'
                ],
                'encodeLabels' => false,
                'items' => [
                    ['label' => '<i class="fa fa-user-circle"></i> ' . Yii::$app->user->identity->getFullname(true),
                        'items' => [
                            ['label' => 'Профиль', 'url' => '/profile'],
                            ['label' => 'Сменить пароль', 'url' => '/profile/change-password'],
                            '<li class="divider"></li>',
                            !Yii::$app->user->isGuest ? ['label' => 'Выйти', 'url' => ['/site/logout']] : ''
                        ]
                    ],
                    [
                        'label' => '<i class="fa fa-cog"></i>',
                        'visible' => Yii::$app->user->can('administrator'),
                        'items' => [
                            ['label' => 'Администрирование'],
                            ['label' => 'Статусы проектов', 'url' => ['/project-status/']],
                            ['label' => 'Типы документов', 'url' => ['/document-type/']],
                            ['label' => 'Папки', 'url' => ['/folder/']],
                            ['label' => 'ОПФ', 'url' => ['/opf/']],
                            ['label' => 'Основания полномочий', 'url' => ['/authority-basis/']],
                            ['label' => 'Учетные записи'],
                            ['label' => 'Пользователи', 'url' => ['/user/']],
                        ]
                    ],
                ],
            ]);
            ?>
            <?php NavBar::end(); ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <header>
                        <h1><?= Html::encode($this->title) ?></h1>
                    </header>

                    <?= AlertBlock::widget() ?>

                    <?= $content ?>
                </div>
            </div>
        </div>



        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
