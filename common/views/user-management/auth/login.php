<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var webvimark\modules\UserManagement\models\forms\LoginForm $model */


use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
$this->title = 'Авторизация';
$this->registerCssFile('@web/css/portal/login.css');

?>

<div class="site-login">
    <div class="row">
        <div class="col-md-7 mx-auto login-box-site">
            <div class="login-image-block">
                <?php echo Html::img('@web/css/portal/img/login.jfif'); ?>
            </div>
            <?php $form = ActiveForm::begin([
                'id'      => 'login-form',
                'options' => ['autocomplete'=>'off'],
                'layout' => 'floating',
            ]) ?>
            <h2 class="text-center mb-4">Войти</h2>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label() ?>

            <?= $form->field($model, 'password')->passwordInput()->label() ?>

            <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнит меня') ?>

            <div class="form-group button-block">
                <?= Html::submitButton('Войти', ['class' => 'bthp btn-success', 'name' => 'login-button']) ?>
                <?= Html::a('Зарегестрироваться', ['site/signup'], ['class' => 'bthp btn-primary abthp']) ?>
            </div>
            <div class="reset-pass">
                <?= Html::a('Восстановить пароль', ['site/request-password-reset']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
