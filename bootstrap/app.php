<?php

use App\Core\App;

use App\Config\Config;
use App\Core\Container;
use Router\Router\Router;
use App\Controller\WelcomeController;
use App\Provider\ConfigServiceProvider;
use App\Provider\RouteServiceProvider;
use League\Container\ReflectionContainer;

error_reporting(0);

require_once __DIR__ . '/../vendor/autoload.php';


$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotEnv->load();

$container = Container::getInstance();

$container->delegate(new ReflectionContainer());


$container->addServiceProvider(new ConfigServiceProvider());
$container->addServiceProvider(new RouteServiceProvider());

$config = $container->get(Config::class);


foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}


$app = new App();

$app->run();