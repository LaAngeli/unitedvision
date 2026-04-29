<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ro-RO',
    'timeZone' => 'Europe/Chisinau',
    'defaultRoute' => 'home/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UNvU_QGdPMDkjfj9sQ_QkEz5Wb0QqxDS',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\user\User',
            'loginUrl' => '/auth/login',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'home/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'scheme' => 'smtps',
                'host' => 'smtp.mail.ru',
                'username' => 'ciobanu-23@inbox.ru',
                'password' => 'uiSkdpgiawvTXYCYzgk9',
                'port' => 465,
                'encryption' => 'ssl',
            ],
            // send all mails to a file by default.

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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'brand/details/<id>/<name>' => 'brand/details',
                'brand/category/<category_id>/<name>' => 'brand/category',
                'admin/category/search/<name>/<page>' => 'admin/category/search',
                'admin/<controller>/search' => 'admin/<controller>/search',
                'admin/<controller>/<action>/<page:\d+>' => 'admin/<controller>/<action>',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //uncomment if you want to cache RBAC items hierarchy
            'cache' => 'cache',
        ],
    ],

    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
            // 'defaultRoute' => 'home/index'
        ],
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
