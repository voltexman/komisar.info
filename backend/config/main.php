<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'devicedetect'],
    'modules' => [],
    'name' => 'Komisar.Info',
    'language' => 'ru',
    'components' => [
//        'yandexMapsApi' => [
//            'class' => 'mirocow\yandexmaps\Api',
//        ],
//        'assetManager' => [
//            'bundles' => [
//                'dosamigos\google\maps\MapAsset' => [
//                    'options' => [
//                        'key' => 'AIzaSyBK8ILpaiYgLwIcynKlmBqy4psFVpYxFg8',
//                        'language' => 'ru',
//                        'version' => '3.1.18'
//                    ]
//                ]
//            ]
//        ],
        'devicedetect' => [
            'class' => 'alexandernst\devicedetect\DeviceDetect'
        ],
        'request' => [
            'baseUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
    ],
    'as access' => [
        'class' => 'yii\filters\AccessControl',
        // 'only' only ...
        // 'except' everyone without ...
        'except' => [
            'site/login',
            'site/error'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];
