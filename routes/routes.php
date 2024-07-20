<?php

use App\Http\Controller\Auth\AuthenticateController;
use App\Http\Controller\Auth\RegisterController;
use App\Http\Controller\DashboardController;
use Router\Router\Router;
use App\Http\Controller\WelcomeController;

return function (Router $router) {

    $router->addRoute('/', [WelcomeController::class, 'index']);
    $router->addRoute('/login', [AuthenticateController::class, 'create']);
    $router->addRoute('/login/user', [AuthenticateController::class, 'store'], 'POST');
    $router->addRoute('/register', [RegisterController::class, 'create']);
    $router->addRoute('/register/user', [RegisterController::class, 'store'], 'POST');
    $router->addRoute('/dashboard', [DashboardController::class, 'index']);
};
