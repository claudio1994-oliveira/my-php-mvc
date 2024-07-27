<?php

use App\Core\App;
use App\Core\Container;

require_once __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../bootstrap/app.php";

$container = Container::getInstance();
$app = new App($container);

$app->run();
