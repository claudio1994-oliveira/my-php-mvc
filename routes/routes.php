<?php

use Router\Router\Router;
use App\Controller\WelcomeController;

return function (Router $router) {
    $router->addRoute('/', [WelcomeController::class, 'index']);
};
