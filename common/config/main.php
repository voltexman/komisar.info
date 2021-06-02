<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'gallery' => [
            'class' => 'dvizh\gallery\Module',
            'imagesStorePath' => dirname(dirname(__DIR__)) . '/frontend/web/images/store', //path to origin images
            'imagesCachePath' => dirname(dirname(__DIR__)) . '/frontend/web/images/cache', //path to resized copies
            'graphicsLibrary' => 'GD',
            'placeHolderPath' => '@webroot/images/placeHolder.png',
            'adminRoles' => ['@'],
        ],
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'formatter' => [
            'class'           => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Kiev',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 's12.thehost.com.ua',
                'username' => 'admin@komisar.info',
                'password' => 'n7AtVRIU',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
    ],
];
