<?php

use common\models\forms\CourseForm;
use common\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Создание предмета';

/** @var $model CourseForm */
?>

<div class="row">
    <div class="col-9 content-block p-0">
        <div class="title-bg p-3">
            <h2 class="lte-hide-title"><?= $this->title ?></h2>
        </div>
        <div class="p-3">
            <?php $form = ActiveForm::begin([
                'id' => 'course-form',
                'options' => ['autocomplete' => 'off'],
                'layout' => 'floating',
            ]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="row justify-content-center">
                        <div class="img-load-block position-relative mt-3">
                            <div class="round-plus col">
                                <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.811 28.616V0.584H17.187V28.616H11.811ZM0.163 17.16V12.104H28.835V17.16H0.163Z"
                                          fill="#4D954C"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-8">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label() ?>
                    </div>
                    <div class="col-md-8">
                        <?= $form->field($model, 'class_id')->dropDownList([
                            '0' => '1 класс',
                            '1' => '2 класс',
                            '2' => '3 класс'
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button class="bthp drop-button bttn-button">Отмена</button>
                <button class="bthp btn-success">Сохранить</button>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <div class="col-3 pl-2">
        <div class="content-menu content-block">
            <ul class="list-group">
                <?php if (User::hasPermission('Course')) { ?>
                    <a class="list-group-item" href="<?= Url::toRoute('/course/add', true) ?>">Темы и уроки курса</a>
                <?php } ?>
                <?php if (User::hasPermission('AddStudent')) { ?>
                    <a class="list-group-item" href="<?= Url::toRoute('/student/add', true) ?>">Добавить учеников</a>
                <?php } ?>
                <?php if (User::hasPermission('DeletedCourse')) { ?>
                    <a class="list-group-item" href="#">Удаленные уроки</a>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

