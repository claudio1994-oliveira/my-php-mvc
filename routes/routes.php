<?php

use App\Http\Controller\Auth\AuthenticateController;
use App\Http\Controller\Auth\RegisterController;
use Router\Router\Router;
use App\Http\Controller\WelcomeController;

return function (Router $router) {
    $router->addRoute('/', [WelcomeController::class, 'index']);
    $router->addRoute('/login', [AuthenticateController::class, 'create']);
    $router->addRoute('/register', [RegisterController::class, 'create']);
};
