<?php

/** @var yii\web\View $this */

use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

?>

<div class="row">
    <div>
        <h5>Admin</h5>
        <?php
        echo GhostMenu::widget([
            'encodeLabels' => false,
            'activateParents' => true,
            'options' => ['class' => 'list-group'],
            'items' => [
                ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['/user-management/user/index'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('back', 'Roles'), 'url' => ['/user-management/role/index'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('back', 'Permissions'), 'url' => ['/user-management/permission/index'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('back', 'Permission groups'), 'url' => ['/user-management/auth-item-group/index'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('back', 'Visit log'), 'url' => ['/user-management/user-visit-log/index'], 'options' => ['class' => 'list-group-item']],
            ],
        ]);
        ?>
    </div>

    <div class="mt-4">
        <h5>Cabinet</h5>
        <?php
        echo GhostMenu::widget([
            'encodeLabels' => false,
            'activateParents' => true,
            'options' => ['class' => 'list-group'],
            'items' => [
                ['label' => UserManagementModule::t('front', 'Login'), 'url' => ['/user-management/auth/login'], 'options' => ['class' => 'list-group-item']],
//                ['label' => UserManagementModule::t('front', 'Logout'), 'url' => ['/user-management/auth/logout'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('front', 'Registration'), 'url' => ['/user-management/auth/registration'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('back', 'Change own password'), 'url' => ['/user-management/auth/change-own-password'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('front', 'Password recovery'), 'url' => ['/user-management/auth/password-recovery'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('front', 'Confirm E-mail'), 'url' => ['/user-management/auth/confirm-email'], 'options' => ['class' => 'list-group-item']],
            ],
        ]);
        ?>
    </div>

    <div class="mt-4">
        <h5>Frontend</h5>
        <?php
        echo GhostMenu::widget([
            'encodeLabels' => false,
            'activateParents' => true,
            'options' => ['class' => 'list-group'],
            'items' => [
                ['label' => UserManagementModule::t('front', 'Login'), 'url' => ['/user-management/auth/login'], 'options' => ['class' => 'list-group-item']],
//                ['label' => UserManagementModule::t('front', 'Logout'), 'url' => ['/user-management/auth/logout'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('front', 'Registration'), 'url' => ['/user-management/auth/registration'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('back', 'Change own password'), 'url' => ['/user-management/auth/change-own-password'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('front', 'Password recovery'), 'url' => ['/user-management/auth/password-recovery'], 'options' => ['class' => 'list-group-item']],
                ['label' => UserManagementModule::t('front', 'Confirm E-mail'), 'url' => ['/user-management/auth/confirm-email'], 'options' => ['class' => 'list-group-item']],
            ],
        ]);
        ?>
    </div>
</div>