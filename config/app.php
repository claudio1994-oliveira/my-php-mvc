<?php

use App\Provider\AppServiceProvider;
use App\Provider\RouteServiceProvider;

return [

    'name' => env('APP_NAME', 'App'),
    'debug' => env('APP_DEBUG', false),

    'providers' => [
        AppServiceProvider::class,
        RouteServiceProvider::class,
    ],

];
