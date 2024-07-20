<?php

// 'default' => env('MAIL_MAILER', 'smtp'),

// 'smtp' => [
//     'transport' => 'smtp',
//     'host' => env('MAIL_HOST', 'smtp.gmail.com'),
//     'port' => env('MAIL_PORT', 587),
//     'encryption' => env('MAIL_ENCRYPTION', 'tls'),
//     'username' => env('MAIL_USERNAME'),
//     'password' => env('MAIL_PASSWORD'),
//     'timeout' => null,
//     'auth_mode' => null,
// ],
return [

    'driver' => env('MAIL_MAILER', 'smtp'),

    'host' => env('MAIL_HOST', 'smtp.gmail.com'),

    'port' => env('MAIL_PORT', 587),

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'Annissa Komputer'),
        'name' => env('MAIL_FROM_NAME', 'Badri'),
    ],

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
