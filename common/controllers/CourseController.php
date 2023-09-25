<?php

namespace common\controllers;

use common\models\forms\CourseForm;
use Yii;

class CourseController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $course = '';
        return $this->render('index', [
            'course' => $course,
            'user' => Yii::$app->user->identity
        ]);
    }
}