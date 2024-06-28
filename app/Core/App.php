<?php

namespace App\Core;

use App\Views\View;
use Psr\Container\ContainerInterface;
use Router\Router\Router;

class App
{
    public function __construct(protected ContainerInterface $container)
    {
    }

    public function run()
    {
        $this->container->get(Router::class);
        $this->container->get(View::class);
    }
}
