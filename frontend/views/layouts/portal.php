<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\PortalAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
PortalAsset::register($this);

?>
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
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Html::img('@web/css/img/logo.png', ['class' => 'logo']),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-site fixed-top',
            ],
        ]);
        $menuItems = [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
//        if (Yii::$app->user->isGuest) {bthp
//            $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
//        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        if (!Yii::$app->user->isGuest) {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout text-decoration-none bthp']
                )
                . Html::endForm();
        }
        NavBar::end();
        ?>
    </header>
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
    <div class="background-image">
        <?php echo Html::img('@web/css/portal/img/background.png'); ?>
    </div>
    <footer class="footer mt-auto py-3 text-muted">
        <div class="container footer-flex">
            <?php echo Html::img('@web/css/img/logo.png', ['class' => 'logo']) ?>
            <div class="social-icon-block">
                <?=Html::img('@web/css/img/vk.svg', ['class' => 'icon-social'])?>
                <?=Html::img('@web/css/img/WA.svg', ['class' => 'icon-social'])?>
                <?=Html::img('@web/css/img/web.svg', ['class' => 'icon-social'])?>
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
