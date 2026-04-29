<?php

$hostName = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
$normalizedHost = preg_replace('/:\d+$/', '', (string) $hostName);
$isLocal = in_array($normalizedHost, ['localhost', '127.0.0.1', '::1'], true);

if ($isLocal) {
    $db = [
        'host' => 'localhost',
        'dbname' => 'unitedvision',
        'username' => 'root',
        'password' => 'root',
    ];
} else {
    // Production credentials are read from environment variables.
    $db = [
        'host' => getenv('UV_DB_HOST') ?: 'localhost',
        'dbname' => getenv('UV_DB_NAME') ?: '',
        'username' => getenv('UV_DB_USER') ?: '',
        'password' => getenv('UV_DB_PASS') ?: '',
    ];
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$db['host']};dbname={$db['dbname']}",
    'username' => $db['username'],
    'password' => $db['password'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
