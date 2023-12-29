<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Router\Router\Router;
$router = new Router();

/*
 * Add routes here
 */

$router->addRoute('/', 'App\Controller\WelcomeController@processesRequest');

return $router;