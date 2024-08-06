<?php

use App\Provider\AppServiceProvider;
use App\Provider\BuilderServiceProvider;
use App\Provider\CSRFServiceProvider;
use App\Provider\SessionServiceProvider;
use App\Provider\ViewServiceProvider;
use App\Provider\RouteServiceProvider;
use App\Provider\RequestServiceProvider;


return [

    'name' => env('APP_NAME', 'App'),
    'debug' => env('APP_DEBUG', false),

    'providers' => [
        AppServiceProvider::class,
        RouteServiceProvider::class,
        ViewServiceProvider::class,
        RequestServiceProvider::class,
        SessionServiceProvider::class,
        BuilderServiceProvider::class,
        CSRFServiceProvider::class,
    ],

];
