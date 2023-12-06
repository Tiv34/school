<?php

use common\models\forms\CourseForm;
use yii\bootstrap5\ActiveForm;

$this->title = 'Уроки';

/** @var $course */
?>
<div class="content-block p-3">
    <?php
    if ($course) { ?>

    <?php } else { ?>
        <p class="text-center">
            Здесь нет еще ни одного урока.
        </p>
    <?php } ?>
</div>
