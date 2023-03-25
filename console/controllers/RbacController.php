<?php
namespace console\controllers;

use Yii;
use yii\base\Exception;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * @throws Exception
     * @throws \Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $createCourse = $auth->createPermission('createCourse');
        $createCourse->description = 'Create a course';
        $auth->add($createCourse);

        $updateCourse = $auth->createPermission('updateCourse');
        $updateCourse->description = 'Update course';
        $auth->add($updateCourse);

        $createStudent = $auth->createPermission('createStudent');
        $createStudent->description = 'Create student';
        $auth->add($createStudent);

        $updateStudent = $auth->createPermission('updateStudent');
        $updateStudent->description = 'Update student';
        $auth->add($updateStudent);

        $teacher = $auth->createRole('teacher');
        $auth->add($teacher);
        $auth->addChild($teacher, $createCourse);
        $auth->addChild($teacher, $updateCourse);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $teacher);
        $auth->addChild($admin, $createStudent);
        $auth->addChild($admin, $updateStudent);

        $auth->assign($admin, 1);
        $auth->assign($teacher, 2);
    }
}