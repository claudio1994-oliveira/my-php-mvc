<?php

namespace App\Core;

use Router\Router\Router;

class App
{
    public function run()
    {
        $container = Container::getInstance();
        $container->get(Router::class);
    }
}
