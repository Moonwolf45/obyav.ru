<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'defaultRoute' => 'category/index',
    'modules' => [
        'admin' => [
            'class' => 'app\module\admin',
            'layout' => 'admin',
            'defaultRoute' => 'advert/index',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            'imagesStorePath' => 'images/advert/original', //path to origin images
            'imagesCachePath' => 'images/advert/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@webroot/images/advert/no_photo.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
            'imageCompressionQuality' => 95, // Optional. Default value is 85.
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'H4rmTBFGtUplzhKJlODNMbwo1Du5F8jw',
            'BaseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true, // использовать ЧПУ
            'showScriptName' => false, // убирает имя файла (index.php) из url
            'rules' => [
                // Категории
                'category/<name:([a-zA-Z0-9-_]+)>/page/<page:\d+>' => 'category/view',
                'category/<name:([a-zA-Z0-9-_]+)>' => 'category/view',
                '/page/<page:\d+>' => 'category/index',
                '' => 'category/index',
                // Объявления
                'advert/<id:\d+>' => 'advert/view',
                // Поиск
                'search' => 'category/search',
                // Страницы статические
                'pages/<name:([a-zA-Z0-9-_]+)>' => 'pages/view',
                // Авторизация
                'login' => 'site/login',
                // Личный кабинет
                'kabinet' => 'kabinet/index',
                'kabinet/edit-profile/<id:\d+>' => 'kabinet/edit-profile',
                'kabinet/edit/<id:\d+>' => 'kabinet/edit',
                // Админка объявления
                'admin/advert/filter/<city:([a-zA-Z0-9а-яА-Я-_]+)>/page/<page:\d+>' => 'admin/advert/index',
                'admin/advert/filter/<city:([a-zA-Z0-9а-яА-Я-_]+)>' => 'admin/advert/index',
                'admin/advert/page/<page:\d+>' => 'admin/advert/index',
                'admin/advert' => 'admin/advert/index',
                'admin/advert/<id:\d+>' => 'admin/advert/view',
                // Админка категории
                'admin/category/page/<page:\d+>' => 'admin/category/index',
                'admin/category' => 'admin/category/index',
                'admin/category/edit/<id:\d+>' => 'admin/category/edit',
                // Админка модераторы
                'admin/moderate/user-<id:\d+>/page/<page:\d+>' => 'admin/moderate/view-adverts',
                'admin/moderate/user-<id:\d+>' => 'admin/moderate/view-adverts',
                'admin/moderate/advert-<id:\d+>' => 'admin/moderate/adverts',
                // Админка города
                'admin/city/user-<id:\d+>/page/<page:\d+>' => 'admin/city/index',
                'admin/city' => 'admin/city/index',
                'admin/city/edit/<id:\d+>' => 'admin/city/edit',
                'admin/city/del/<id:\d+>' => 'admin/city/del',
            ],
        ],
        'geoip' => [
            'class' => 'lysenkobv\GeoIP\GeoIP'
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'path' => 'files',
                'name' => 'Files'
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
