<?php

use common\models\User;
use common\widgets\Menu;
use webvimark\modules\UserManagement\UserManagementModule;


$menuItems = [
    [
        'items' => [
            [
                'url' => ['/'],
                'icon' => 'main',
                'visible' => User::hasPermission('home'),
                'label' => 'Главная',
            ]
        ],
    ],
    [
        'label' => 'Обучение',
        'items' => [
            [
                'url' => ['/course/'],
                'icon' => 'course',
                'options' => ['class' => 'sub-nav-width-sm'],
//                'visible' => User::hasPermission('course'),
                'visible' => true,
                'label' => 'Уроки',
            ],
            [
                'url' => ['/homework/'],
                'icon' => 'audit',
//                'visible' => User::hasPermission('checkingHomework'),
                'visible' => true,
                'label' => 'Проверка ДЗ',
            ],
            [
                'url' => ['/course/options'],
                'icon' => 'curse-options',
                'options' => ['class' => 'sub-nav-width-sm'],
//                'visible' => User::hasPermission('checkingHomework'),
                'visible' => true,
                'label' => 'Настройки курса',
            ],
        ],
    ],
    [
        'label' => 'CRM',
//        'visible' => User::hasPermission('CRM'),
        'visible' => true,
        'items' => [
            [
                'url' => ['/crm/lid/'],
                'icon' => 'lids',
                'options' => ['class' => 'sub-nav-height-sm'],
//                'visible' => User::hasPermission('lids'),
                'visible' => true,
                'label' => 'Лиды',
            ],
            [
                'url' => ['/crm/tasks/'],
                'icon' => 'tasks',
                'options' => ['class' => 'sub-nav-width-sm'],
//                'visible' => User::hasPermission('tasks'),
                'visible' => true,
                'label' => 'Задачи',
            ],
            [
                'url' => ['/crm/student/'],
                'icon' => 'student',
                'options' => ['class' => 'sub-nav-width-sm'],
                'visible' => true,
                'label' => 'Ученики',
            ],
            [
                'url' => ['crm/staff/'],
                'icon' => 'staff',
                'options' => ['class' => 'sub-nav-height-sm'],
                'visible' => true,
                'label' => 'Сотрудники',
            ],
            [
                'url' => ['/crm/network/access-list'],
                'icon' => 'schedule',
                'options' => ['class' => 'sub-nav-width-sm'],
                'visible' => true,
                'label' => 'Расписание',
            ],
            [
                'url' => ['#'],
                'icon' => 'users',
                'visible' => true,
                'label' => 'Управление пользователями',
                'options' => ['class' => 'sub-nav-toggle'],
                'submenu' => [
                    [
                        'url' => ['/user-management/user/index'],
                        'visible' => true,
                        'label' => UserManagementModule::t('back', 'Users'),
                    ],
                    [
                        'url' => ['/user-management/role/index'],
                        'visible' => true,
                        'label' => UserManagementModule::t('back', 'Roles'),
                    ],
                    [
                        'url' => ['/user-management/permission/index'],
                        'visible' => true,
                        'label' => UserManagementModule::t('back', 'Permissions'),
                    ],
                    [
                        'url' => ['/user-management/auth-item-group/index'],
                        'visible' => true,
                        'label' => UserManagementModule::t('back', 'Permission groups'),
                    ],
                    [
                        'url' => ['/user-management/user-visit-log/index'],
                        'visible' => true,
                        'label' => UserManagementModule::t('back', 'Visit log'),
                    ],
                ],
            ],
        ],
    ],
];

$help = [
    [
        'items' => [
            [
                'url' => ['/help'],
                'icon' => 'help',
                'visible' => true,
                'label' => 'Поддержка',
            ]
        ],
    ],
];

?>
<ul>
    <li class="main-nav-toggle">
        <button>
            <svg class="main-nav-open">
                <use href="#icon-nav-menu"/>
            </svg>
            <svg class="main-nav-close">
                <use href="#icon-nav-arrow-left"/>
            </svg>
            <span>Свернуть</span>
        </button>
    </li>
    <li class="main-nav-divider">
        <hr/>
    </li>
    <?= Menu::widget([
        'items' => $menuItems,
    ]); ?>
    <li class="main-nav-divider">
        <hr/>
        <?= Menu::widget([
            'items' => $help,
        ]); ?>
    </li>
</ul>
