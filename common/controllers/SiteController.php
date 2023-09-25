<?php

namespace common\controllers;

use common\models\forms\LoginForm;
use Yii;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    private string $login_url;

    public $freeAccessActions = ['login', 'logout'];

    public function __construct($id, $module, $config = [])
    {
        $this->login_url = Yii::$app->id === 'app-backend' ? 'loginCms' : 'login';
        parent::__construct($id, $module, $config);
    }

    /**
     * Displays homepage.
     *
     * @return Response | string | array
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        }
        return $this->redirect('/user-management/auth/login');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $model->addAccessPlatform();
            return $this->goBack();
        }

        $model->password = '';

        return $this->render($this->login_url, [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
