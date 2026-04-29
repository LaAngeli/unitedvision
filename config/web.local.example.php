<?php

/**
 * Copy this file to `config/web.local.php` (gitignored) and fill in secrets.
 *
 * Notes:
 * - `cookieValidationKey` must be a long random string (required by Yii).
 * - SMTP credentials should never be committed to Git.
 */
return [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'CHANGE_ME_LONG_RANDOM_STRING',
        ],
        'mailer' => [
            // For local/dev you can keep file transport:
            // 'useFileTransport' => true,
            //
            // For production SMTP (example for Mail.ru over implicit TLS on 465):
            'useFileTransport' => false,
            'transport' => [
                'scheme' => 'smtps',
                'host' => 'smtp.mail.ru',
                'username' => 'CHANGE_ME_SMTP_USER',
                'password' => 'CHANGE_ME_SMTP_PASS',
                'port' => 465,
            ],
        ],
    ],
];
