<?php

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\User $model
 * @var yii\bootstrap5\ActiveForm $form
 */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin([
		'id'=>'user',
        'layout' => 'floating',
		'validateOnBlur' => false,
	]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model->loadDefaultValues(), 'status')
                ->dropDownList(User::getStatusList()) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>
        </div>
    </div>

	<?php if ( $model->isNewRecord ): ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off']) ?>

            </div>
        </div>
	<?php endif; ?>

    <div class="row">
	<?php if ( User::hasPermission('bindUserToIp') ): ?>
        <div class="col-md-6">
		<?= $form->field($model, 'bind_to_ip')
			->textInput(['maxlength' => 255])
			->hint(UserManagementModule::t('back','For example: 123.34.56.78, 168.111.192.12')) ?>
        </div>
	<?php endif; ?>

	<?php if ( User::hasPermission('editUserEmail') ): ?>
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'email_confirmed')->checkbox() ?>
            </div>
	<?php endif; ?>
    </div>


	<div class="form-group">
		<div class="col-sm-offset-3 d-flex justify-content-end">
			<?php if ( $model->isNewRecord ): ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-plus-sign"></span> ' . UserManagementModule::t('back', 'Create'),
					['class' => 'btn btn-success']
				) ?>
			<?php else: ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save'),
					['class' => 'btn btn-primary']
				) ?>
			<?php endif; ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>