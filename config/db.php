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
    // Shared hosting often does not expose a UI for environment variables.
    // Prefer `config/db.local.php` (gitignored) on the server.
    $localOverride = __DIR__ . '/db.local.php';
    if (is_file($localOverride)) {
        $override = require $localOverride;
        if (!is_array($override)) {
            throw new \RuntimeException('Invalid DB config: `config/db.local.php` must return an array.');
        }

        $db = [
            'host' => (string) ($override['host'] ?? 'localhost'),
            'dbname' => (string) ($override['dbname'] ?? ''),
            'username' => (string) ($override['username'] ?? ''),
            'password' => (string) ($override['password'] ?? ''),
            'charset' => (string) ($override['charset'] ?? 'utf8mb4'),
        ];
    } else {
        // Optional: production credentials via environment variables (if available).
        $db = [
            'host' => getenv('UV_DB_HOST') ?: 'localhost',
            'dbname' => getenv('UV_DB_NAME') ?: '',
            'username' => getenv('UV_DB_USER') ?: '',
            'password' => getenv('UV_DB_PASS') ?: '',
            'charset' => getenv('UV_DB_CHARSET') ?: 'utf8mb4',
        ];
    }
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$db['host']};dbname={$db['dbname']}",
    'username' => $db['username'],
    'password' => $db['password'],
    'charset' => $db['charset'] ?? 'utf8mb4',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
