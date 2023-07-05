<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';
$this->registerCssFile('@web/css/portal/login.css');
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h2 class="text-center mb-4">Авторизация в панель администратора</h2>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label() ?>
            <?= $form->field($model, 'password')->passwordInput()->label() ?>

            <div class="form-group d-flex justify-content-center">
                <?= Html::submitButton('Войти', ['class' => 'bthp btn-success', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
