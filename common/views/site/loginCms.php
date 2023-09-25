<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var webvimark\modules\UserManagement\models\forms\LoginForm $model */


use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Авторизация';
$this->registerCssFile('@web/css/portal/login.css');

?>
<style>
    .form-floating > label {
        left: 0!important;
    }
</style>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6 d-flex flex-column align-items-center">
        <h2 class="text-center mb-4">Авторизация в панель администратора</h2>
        <?php $form = ActiveForm::begin([
            'id'      => 'login-form',
            'options' => ['autocomplete'=>'off'],
            'layout' => 'floating',
        ]) ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label() ?>
        <?= $form->field($model, 'password')->passwordInput()->label() ?>
        <?= (isset(Yii::$app->user->enableAutoLogin) && Yii::$app->user->enableAutoLogin) ? $form->field($model, 'rememberMe')->checkbox(['value'=>true, 'class'=>'form-check-input']) : '' ?>

        <div class="form-group d-flex justify-content-center">
            <?= Html::submitButton('Войти', ['class' => 'bthp btn-success', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
