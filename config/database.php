<?php

return [
    'driver' => env('DB_CONNECTION', 'mysql'),
    'mysql' => [
        'host' => env('DB_HOST', 'localhost'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'app'),
        'username' => env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ],
    'sqlite' => [
        'driver' => 'sqlite',
        'database' => env('DB_DATABASE', 'database.sqlite'),
        'path' => env('DB_PATH', __DIR__ . '/../database'),
        'prefix' => '',
    ],
];
