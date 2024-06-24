<?php

use Router\Router\Router;
use App\Controller\WelcomeController;

$router = new Router();

$router->addRoute('/', [WelcomeController::class, 'index']);

return $router;
