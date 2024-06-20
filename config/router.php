<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\WelcomeController;
use Router\Router\Router;

$router = new Router();

/*
 * Add routes here
 */

$router->addRoute('/', [WelcomeController::class, 'index']);

return $router;
