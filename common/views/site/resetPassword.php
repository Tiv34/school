<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var ResetPasswordForm $model */

use frontend\models\ResetPasswordForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Восстановление пароля';
$this->registerCssFile('@web/css/portal/login.css');
?>

<div class="site-login">
    <div class="row">
        <div class="col-md-7 mx-auto login-box-site">
            <div class="login-image-block">
                <?php echo Html::img('@web/css/portal/img/login.jfif'); ?>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'layout' => 'floating']); ?>
            <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
            <p class="text-center mb-4">Пожалуйста, выберите свой новый пароль:</p>
            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'Пароль'])->label(false) ?>
            <div class="form-group button-block">
                <?= Html::submitButton('Сохранить', ['class' => 'bthp btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
