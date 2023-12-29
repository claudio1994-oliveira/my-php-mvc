<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Router\Router\Router;

$router = new Router();

$router->addRoute('/', 'App\Controller\QuestionListController@processesRequest');

return $router;