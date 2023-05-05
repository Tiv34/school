<?php

/** @var yii\web\View $this */
/** @var $model */


$this->registerCssFile('@web/css/portal/login.css');

$this->title = 'Регистрация';
?>
<div class="site-login">
    <div class="row">
        <div class="col-md-8 mx-auto login-box-site flex-column verify-block">
                <h2 class="text-center mb-4">Регистрация</h2>
                <p>Подтверждение электронной почты</p>
            <div class="row pt-3">
               <div class="col text-center">
                   <h4><?=$model->username?>, <?=$model->email?></h4>
                   <p>Вам на почту отправлено письмо для подтверждения. Пройдите по присланной ссылке и войдите в личный кабинет.</p>
               </div>
            </div>
        </div>
    </div>
</div>
