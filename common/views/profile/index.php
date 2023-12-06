<?php

/** @var UserForm $model */
/** @var User $user */

use common\models\forms\UserForm;
use common\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

?>
<style>
    .form-control {
        background: white !important;
    }
</style>
<div class="row menu-mob">
    <div class="col-lg-9 content-block p-4">
        <?php $form = ActiveForm::begin(['id' => 'profile-form', 'layout' => 'floating']); ?>
            <div class="collapse-val row" id="collapse-1">
                <h2>Личные данные</h2>

                <div class="form-group d-flex align-items-center">
                    <div class="img-load-block position-relative col-4 mt-3">
                        <div class="round-plus">
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.811 28.616V0.584H17.187V28.616H11.811ZM0.163 17.16V12.104H28.835V17.16H0.163Z" fill="#4D954C"/>
                            </svg>
                        </div>
                    </div>
                    <div class="col-8 form-margin-l-20">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'value' => $user->name])->label() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'surname')->textInput(['autofocus' => true, 'value' => $user->surname])->label() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'city')->textInput(['autofocus' => true, 'value' => $user->city])->label() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'phone')->textInput(['autofocus' => true, 'value' => $user->phone])->label() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'value' => $user->email])->label() ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'timezone')->textInput(['autofocus' => true, 'value' => $user->timezone])->label() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="button-profile-block">
                <div>
                    <button class="btn-green drop-button">Отмена</button>
                    <button class="btn-green">Сохранить</button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-3 pl-2">
        <div class="content-menu content-block">
            <ul class="list-group">
                <li class="list-group-item collapse-opt active"><a href="<?= Url::toRoute('/profile/', true) ?>">Личные данные</a></li>
                <li class="list-group-item collapse-opt disabled">Безопасность</li>
                <li class="list-group-item collapse-opt disabled"><a href="<?= Url::toRoute('/profile/notifications', true) ?>">Уведомления</a></li>
            </ul>
        </div>
    </div>
</div>
