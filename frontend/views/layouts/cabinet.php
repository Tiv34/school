<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\PortalAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use kartik\sidenav\SideNav;


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
        if (!Yii::$app->user->isGuest) {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex justify-content-end w-100']); ?>
<!--//            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex flex-row-reverse w-100'])-->
<!--//                . Html::submitButton(-->
<!--//                    'Logout (' . Yii::$app->user->identity->username . ')',-->
<!--//                    ['class' => 'btn btn-link logout text-decoration-none bthp']-->
<!--//                )-->
<!--//                . Html::endForm();-->

            <div class="position-relative">
                <svg  class="position-relative" width="22" height="26" viewBox="0 0 36 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M31.4455 28.5714V18.6667C30.4628 18.8571 29.4802 19.0476 28.4975 19.0476H27.5148V30.4762H7.86138V17.1429C7.86138 11.8095 12.1851 7.61905 17.6881 7.61905C17.8846 5.14286 19.0638 3.04762 20.6361 1.33333C20.0465 0.571429 18.8673 0 17.6881 0C15.5262 0 13.7574 1.71429 13.7574 3.80952V4.38095C7.86138 6.09524 3.93069 11.2381 3.93069 17.1429V28.5714L0 32.381V34.2857H35.3762V32.381L31.4455 28.5714ZM13.7574 36.1905C13.7574 38.2857 15.5262 40 17.6881 40C19.85 40 21.6188 38.2857 21.6188 36.1905H13.7574Z" fill="#4D954C"/>
                </svg>
                <div class="notifications-count">99</div>
            </div>
            <div class="position-relative profile-block d-flex">
                <h5><?=Yii::$app->user->identity->username ?></h5>
                <a href="#">
                    <svg width="27" height="27" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7002 36.0889C20.7431 34.9139 26.2808 35.015 34.3343 36.1301C34.9175 36.2146 35.4504 36.5073 35.8347 36.9542C36.2189 37.401 36.4284 37.9718 36.4246 38.5611C36.4246 39.1251 36.2307 39.6727 35.8806 40.1004C35.2703 40.8461 34.6451 41.5794 34.0053 42.3H37.1085C37.3035 42.0673 37.4997 41.83 37.6983 41.5891C38.3953 40.7344 38.7755 39.6651 38.7746 38.5623C38.7746 36.1829 37.038 34.1326 34.6562 33.8036C26.4124 32.6626 20.6502 32.5534 12.3606 33.7648C9.95421 34.1161 8.22461 36.1982 8.22461 38.594C8.22461 39.6574 8.57123 40.709 9.22806 41.5609C9.42193 41.8123 9.61346 42.0591 9.80381 42.3011H12.8318C12.2366 41.5885 11.656 40.8638 11.0904 40.1274C10.7543 39.6866 10.573 39.1472 10.5746 38.5929C10.5746 37.3274 11.4841 36.2663 12.7002 36.0889ZM23.4996 24.675C24.4254 24.675 25.3422 24.4926 26.1975 24.1383C27.0529 23.784 27.8301 23.2647 28.4847 22.6101C29.1394 21.9554 29.6587 21.1782 30.013 20.3229C30.3673 19.4675 30.5496 18.5508 30.5496 17.625C30.5496 16.6992 30.3673 15.7824 30.013 14.9271C29.6587 14.0717 29.1394 13.2945 28.4847 12.6399C27.8301 11.9852 27.0529 11.4659 26.1975 11.1116C25.3422 10.7573 24.4254 10.575 23.4996 10.575C21.6298 10.575 19.8366 11.3177 18.5145 12.6399C17.1924 13.962 16.4496 15.7552 16.4496 17.625C16.4496 19.4948 17.1924 21.2879 18.5145 22.6101C19.8366 23.9322 21.6298 24.675 23.4996 24.675ZM23.4996 27.025C25.9926 27.025 28.3836 26.0346 30.1464 24.2718C31.9093 22.5089 32.8996 20.118 32.8996 17.625C32.8996 15.1319 31.9093 12.741 30.1464 10.9782C28.3836 9.21533 25.9926 8.22498 23.4996 8.22498C21.0066 8.22498 18.6156 9.21533 16.8528 10.9782C15.09 12.741 14.0996 15.1319 14.0996 17.625C14.0996 20.118 15.09 22.5089 16.8528 24.2718C18.6156 26.0346 21.0066 27.025 23.4996 27.025Z" fill="#4D954C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M23.5 44.65C35.1807 44.65 44.65 35.1807 44.65 23.5C44.65 11.8193 35.1807 2.35 23.5 2.35C11.8193 2.35 2.35 11.8193 2.35 23.5C2.35 35.1807 11.8193 44.65 23.5 44.65ZM23.5 47C36.479 47 47 36.479 47 23.5C47 10.521 36.479 0 23.5 0C10.521 0 0 10.521 0 23.5C0 36.479 10.521 47 23.5 47Z" fill="#4D954C"/>
                    </svg>
                </a>
                <svg width="8" height="30" viewBox="0 0 8 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 4C8 6.20914 6.20914 8 4 8C1.79086 8 0 6.20914 0 4C0 1.79086 1.79086 0 4 0C6.20914 0 8 1.79086 8 4Z" fill="#4D954C"/>
                    <path d="M8 21C8 23.2091 6.20914 25 4 25C1.79086 25 0 23.2091 0 21C0 18.7909 1.79086 17 4 17C6.20914 17 8 18.7909 8 21Z" fill="#4D954C"/>
                    <path d="M8 38C8 40.2091 6.20914 42 4 42C1.79086 42 0 40.2091 0 38C0 35.7909 1.79086 34 4 34C6.20914 34 8 35.7909 8 38Z" fill="#4D954C"/>
                </svg>
            </div>

           <?php echo Html::endForm();
        }
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container-fluid container">
            <div class="row flex-nowrap">
                <?= $this->render('@app/views/layouts/menu.php') ?>
                <div class="col py-3 content-block">
                    <div class="container">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="background-image">
        <?php echo Html::img('@web/css/portal/img/background.png'); ?>
    </div>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container footer-flex">
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
