<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var PasswordResetRequestForm $model */

use frontend\models\PasswordResetRequestForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Запросить сброс пароля';
$this->registerCssFile('@web/css/portal/login.css');

?>

<div class="site-login">
    <div class="row">
        <div class="col-md-7 mx-auto login-box-site">
            <div class="login-image-block">
                <?php echo Html::img('@web/css/portal/img/login.jfif'); ?>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'layout' => 'floating']); ?>
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
            <p class="text-center mb-4">Пожалуйста, заполните свой адрес электронной почты. Туда будет отправлена ссылка для сброса пароля.</p>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label() ?>
            <div class="form-group button-block">
                <?= Html::submitButton('Отправить', ['class' => 'bthp btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>