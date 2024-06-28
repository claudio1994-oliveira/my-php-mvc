<?php

use Router\Router\Router;
use App\Http\Controller\WelcomeController;

return function (Router $router) {
    $router->addRoute('/', [WelcomeController::class, 'index']);
};
