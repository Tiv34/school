<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@webvimark' => '@vendor/webvimark/module-user-management',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'modules' => [
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            // 'enableRegistration' => true,
            // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
            // The example below allows user to enter :
            // any set of characters
            // (?=\S{8,}): of at least length 8
            // (?=\S*[a-z]): containing at least one lowercase letter
            // (?=\S*[A-Z]): and at least one uppercase letter
            // (?=\S*[\d]): and at least one number
            // $: anchored to the end of the string
            //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',

            // 'on beforeAction'=>function(yii\base\ActionEvent $event) {
            //    if ($event->action->uniqueId == 'user-management/auth/login')
            //    {
            //        $event->action->controller->layout = 'main.php';
            //    };
            // },
        ],
    ],
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'urlManager' => [
            'class' => yii\web\UrlManager::class,
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
            'loginUrl' => ['site/login'],
            'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@webvimark/views' => '@app/views/user-management'
                ]
            ]
        ],
        'i18n' => [
            'translations' => [
                'modules/user-management/*' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'ru',
                    'basePath'       => '@webvimark/messages',
                    'fileMap'        => [
                        'modules/user-management/back' => 'back.php',
                        'modules/user-management/front' => 'front.php',
                    ],
                ],
            ],
        ],
    ],
];
