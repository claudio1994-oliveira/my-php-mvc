<?php

use App\Http\Controller\Auth\AuthenticateController;
use App\Http\Controller\Auth\RegisterController;
use App\Http\Controller\DashboardController;
use App\Http\Middleware\AuthMiddleware;
use Router\Router\Router;
use App\Http\Controller\WelcomeController;

return function (Router $router) {

    $router->addRoute('/', [WelcomeController::class, 'index']);
    $router->addRoute('/login', [AuthenticateController::class, 'create']);
    $router->addRoute('/login', [AuthenticateController::class, 'store'], 'POST');
    $router->addRoute('/logout', [AuthenticateController::class, 'destroy'], 'POST', [new AuthMiddleware()]);
    $router->addRoute('/register', [RegisterController::class, 'create']);
    $router->addRoute('/register', [RegisterController::class, 'store'], 'POST');
    $router->addRoute('/dashboard', [DashboardController::class, 'index'], 'GET', [new AuthMiddleware()]);
};
