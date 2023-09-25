<?php

namespace common\controllers;

class StudentController extends BaseController
{

    public function actionAdd() {
        return $this->render('add', []);
    }


}