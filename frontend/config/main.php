<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii', 'devicedetect', 'visitStatistics'],
    'modules' => [
        'gii' => ['class' => 'yii\gii\Module', 'allowedIPs' => ['178.74.239.172']],
        'comment' => [
            'class' => 'yii2mod\comments\Module',
            'controllerMap' => [
                'manage' => [
                    'class' => 'yii2mod\comments\controllers\ManageController',
                    'accessControlConfig' => [
                        'class' => 'yii\filters\AccessControl',
                        'rules' => [
                            [
                                'allow' => true,
                                'roles' => ['?'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'layout' => 'default',
    'language' => 'uk',
    'timeZone' => 'Europe/Kiev',
    'name' => 'Komisar.Info',
    'components' => [
        'visitStatistics' => [
            'class' => 'blog\components\VisitStatistics',
        ],
        'devicedetect' => [
            'class' => 'alexandernst\devicedetect\DeviceDetect'
        ],
        'i18n' => [
            'translations' => [
                'yii2mod.comments' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/comments/messages',
                ],
            ],        ],
        'socialShare' => [
            'class' => \ymaker\social\share\configurators\Configurator::class,
            'socialNetworks' => [
                'facebook' => [
                    'class' => \ymaker\social\share\drivers\Facebook::class,
                    'options' => ['class' => 'fb'],
                ],
                'twitter' => [
                    'class' => \ymaker\social\share\drivers\Twitter::class,
                    'options' => ['class' => 'tw'],
                ],
                'pinterest' => [
                    'class' => \ymaker\social\share\drivers\Pinterest::class,
                    'options' => ['class' => 'pt']
                ],
                'odnoklassniki' => [
                    'class' => \ymaker\social\share\drivers\Odnoklassniki::class,
                    'options' => ['class' => 'ok'],
                ],
                'vkontakte' => [
                    'class' => \ymaker\social\share\drivers\Vkontakte::class,
                    'options' => ['class' => 'vk'],
                ],
                'linkedin' => [
                    'class' => \ymaker\social\share\drivers\LinkedIn::class,
                    'options' => ['class' => 'lk'],
                ],
                'telegram' => [
                    'class' => \ymaker\social\share\drivers\Telegram::class,
                    'options' => ['class' => 'tg'],
                ]
            ],
            'enableDefaultIcons' => true,
            'options' => [
                'class' => 'social-icon text-xs-center',
            ],
        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6Lf62C0aAAAAAPhGc6K-l7fUfmvLjn2t7zqOMa51',
            'secretV2' => '6Lf62C0aAAAAABlbdxKgmewe-TpKOqN3o7hApFhe',
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
//                '<controller:(blog|interview)>/<alias>' => '<controller>/view',
//                '<controller:(blog)>/<action>' => '<controller>/',
                'contact' => 'site/contact',
                'favorite' => 'site/favorite',
                '<alias>' => 'blog/view',
//                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
