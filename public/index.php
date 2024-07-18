<?php

use App\Core\App;

require_once __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../bootstrap/app.php";

$container = \App\Core\Container::getInstance();
$app = new App($container);

$app->run();
