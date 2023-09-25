<?php

namespace common\controllers;


use common\models\forms\UserForm;
use Yii;

/**
 * Site controller
 */
class ProfileController extends BaseController
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new UserForm();
        return $this->render('index', [
            'model' => $model,
            'user' => Yii::$app->user->identity
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionSecurity()
    {
        return $this->render('profile/security');
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionNotifications()
    {
        return $this->render('profile/notifications');
    }
}
