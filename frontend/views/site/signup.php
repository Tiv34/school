<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Регистрация';
$this->registerCssFile('@web/css/portal/login.css');
$this->registerCssFile('@web/css/portal/singup.css');
?>

<div class="site-login">
    <div class="row">
        <div class="col-md-8 mx-auto login-box-site">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'layout' => 'floating']); ?>
            <h2 class="text-center mb-4"><?= Html::encode($this->title) ?></h2>
            <p>Пожалуйста, заполните следующие поля для регистрации:</p>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label() ?>
            <?= $form->field($model, 'email')->textInput()->label() ?>
            <?= $form->field($model, 'password')->passwordInput()->label() ?>

            <div class="form-group button-block">
                <?= Html::submitButton('Зарегестрироваться', ['class' => 'bthp btn-success', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="login-image-block">
                <?php echo Html::img('@web/css/portal/img/login.jfif'); ?>
            </div>
        </div>
    </div>
</div>

