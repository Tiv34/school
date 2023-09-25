<?php

namespace common\models\forms;

use Yii;
use webvimark\modules\UserManagement\models\forms\LoginForm as WebvimarkLogin;

/**
 * Login form
 */
class LoginForm extends WebvimarkLogin
{
    public function attributeLabels(): array
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function addAccessPlatform() {
        if ((!$this->getUser()->admin && Yii::$app->id === 'app-backend') || ($this->getUser()->admin && Yii::$app->id === 'app-frontend')) {
            Yii::$app->user->logout();
            $this->addError('username');
        }
    }
}
