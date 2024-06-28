<?php

use App\Provider\AppServiceProvider;
use App\Provider\RouteServiceProvider;
use App\Provider\ViewServiceProvider;
use App\Views\View;

return [

    'name' => env('APP_NAME', 'App'),
    'debug' => env('APP_DEBUG', false),

    'providers' => [
        AppServiceProvider::class,
        RouteServiceProvider::class,
        ViewServiceProvider::class,
    ],

];
