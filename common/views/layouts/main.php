<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\assets\AppAsset;
use common\assets\PortalAsset;
use common\models\User;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
PortalAsset::register($this);

?>
<?php if (Yii::$app->user->isGuest) { ?>
    <style>
        main.main-wrapper {
            grid-template-columns: 0 !important;
            grid-column-gap: 0 !important;
        }
    </style>
<?php } ?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <main class="main-wrapper h-100">
        <aside class="main-nav" id="main-navigation">
            <?php if (!Yii::$app->user->isGuest) { ?>
                <?= $this->render('left'); ?>
            <?php } ?>
        </aside>
        <header>
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('@web/css/img/logo.png', ['class' => 'logo']),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-expand-md navbar-site fixed-top',
                ],
            ]);
            if (!Yii::$app->user->isGuest) { ?>
                <div class="d-flex justify-content-end w-100">
                    <div class="position-relative profile-block d-flex">
                        <a href="<?= Url::toRoute('/profile/', true) ?>"
                           class="profile-block-name"><?= Yii::$app->user->identity->username ?></a>
                        <a href="<?= Url::toRoute('/profile/', true) ?>">
                            <svg>
                                <use href="#icon-profile"/>
                            </svg>
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['/site/logout']); ?>">
                                    <svg>
                                        <use href="#icon-sign-out"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php }
            NavBar::end();
            ?>
        </header>
        <section class="content">
            <div class="content-title mb-2">
                <?php if (!Yii::$app->user->isGuest) { ?>
                    <div>
                        <?= \yii\helpers\Html::tag('h3', $this->title, ['class' => 'mb-0']); ?>
                        <?= isset($this->params['subtitle']) ? \yii\helpers\Html::tag('span', $this->params['subtitle'], ['class' => 'small text-muted']) : ''; ?>
                    </div>
                <?php } ?>

                <div class="view-actions d-flex" style="align-items: flex-start;">
                    <div id="app-spinner" class="spinner hide ml-3" ref="spinner">
                        <div class="outer"></div>
                        <div class="inner"></div>
                    </div>
                    <div class="container-fluid pt-4 pb-4">
                        <div class="row">
                            <div class="col-9">
                            <?php if (!Yii::$app->user->isGuest) { ?>
                                <?= Breadcrumbs::widget([
                                    'links' => $this->params['breadcrumbs'] ?? [],
                                ]) ?>
                            <?php } ?>
                            <?= $content ?>
                            </div>
                            <div class="col-3">
                                <div class="content-menu content-block">
                                    <ul class="list-group">
                                        <?php if (User::hasPermission('Course')) { ?>
                                            <a class="list-group-item" href="<?= Url::toRoute('/course/add', true) ?>">Темы
                                                и уроки курса</a>
                                        <?php } ?>
                                        <?php if (User::hasPermission('AddStudent')) { ?>
                                            <a class="list-group-item" href="<?= Url::toRoute('/student/add', true) ?>">Добавить
                                                учеников</a>
                                        <?php } ?>
                                        <?php if (User::hasPermission('DeletedCourse')) { ?>
                                            <a class="list-group-item" href="#">Удаленные уроки</a>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="background-image">
            <?php echo Html::img('@web/css/portal/img/background.png'); ?>
        </div>

    </main>
    <footer class="footer mt-auto text-muted w-100">
        <div class="container footer-flex" style="height: 70px;">
            <?php echo Html::img('@web/css/img/logo.png', ['class' => 'logo']) ?>
            <div class="social-icon-block">
                <?= Html::img('@web/css/img/vk.svg', ['class' => 'icon-social']) ?>
                <?= Html::img('@web/css/img/WA.svg', ['class' => 'icon-social']) ?>
                <?= Html::img('@web/css/img/web.svg', ['class' => 'icon-social']) ?>
            </div>
            <div>
                <p class="mb-1">9:00-18:00</p>
                <a href="tel:+74995040462">8 (499) 504 04 62</a>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
