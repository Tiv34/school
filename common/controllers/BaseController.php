<?php

namespace common\controllers;

use Yii;
use yii\base\ViewContextInterface;
use yii\web\Controller;


/**
 * Site controller
 */
class BaseController extends Controller implements ViewContextInterface
{
    public function getViewPath()
    {
        $this->layout = '@common/views/layouts/main';
        return Yii::getAlias('@common/views/'. Yii::$app->controller->id);
    }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }
}
