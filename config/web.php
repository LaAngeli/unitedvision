<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$hostName = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
$normalizedHost = preg_replace('/:\d+$/', '', (string) $hostName);
$isLocalWeb = in_array($normalizedHost, ['localhost', '127.0.0.1', '::1'], true);

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
            // Production: set via `config/web.local.php` (gitignored) or `UV_COOKIE_KEY`.
            // Local dev: a stable placeholder is OK (never reuse this on public hosts).
            'cookieValidationKey' => getenv('UV_COOKIE_KEY') ?: ($isLocalWeb ? 'LOCAL_ONLY_NOT_FOR_PRODUCTION_COOKIE_KEY' : ''),
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
            // Safe default for repositories: do not ship SMTP credentials in Git.
            // Configure real SMTP in `config/web.local.php` (gitignored).
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

$mergeConfig = static function (array $base, array $override): array {
    foreach ($override as $key => $value) {
        if (
            is_array($value)
            && array_key_exists($key, $base)
            && is_array($base[$key])
        ) {
            $base[$key] = $mergeConfig($base[$key], $value);
        } else {
            $base[$key] = $value;
        }
    }

    return $base;
};

$localWeb = __DIR__ . '/web.local.php';
if (is_file($localWeb)) {
    $local = require $localWeb;
    if (!is_array($local)) {
        throw new \RuntimeException('Invalid web config: `config/web.local.php` must return an array.');
    }
    $config = $mergeConfig($config, $local);
}

// Basic safety checks for production-like environments.
if (!$isLocalWeb) {
    $cookieKey = (string) ($config['components']['request']['cookieValidationKey'] ?? '');
    if ($cookieKey === '' || $cookieKey === 'LOCAL_ONLY_NOT_FOR_PRODUCTION_COOKIE_KEY') {
        throw new \RuntimeException(
            'Missing `cookieValidationKey`. Create `config/web.local.php` (see `config/web.local.example.php`) or set `UV_COOKIE_KEY`.'
        );
    }

    $useFileTransport = (bool) ($config['components']['mailer']['useFileTransport'] ?? true);
    if ($useFileTransport) {
        throw new \RuntimeException(
            'Mailer is configured with `useFileTransport=true` on a public host. Configure SMTP in `config/web.local.php` (see `config/web.local.example.php`).'
        );
    }

    $transport = $config['components']['mailer']['transport'] ?? null;
    if (!is_array($transport)) {
        throw new \RuntimeException('Mailer transport is not configured. Set it in `config/web.local.php`.');
    }

    if (empty($transport['scheme']) || empty($transport['host'])) {
        throw new \RuntimeException('Mailer transport must include `scheme` and `host` (see `config/web.local.example.php`).');
    }
}

return $config;
