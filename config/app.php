<?php

use App\Provider\AppServiceProvider;

return [

    'name' => env('APP_NAME', 'App'),
    'debug' => env('APP_DEBUG', false),

    'providers' => [
        AppServiceProvider::class
    ],

];
