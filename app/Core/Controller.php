<?php

namespace App\Core;

use App\Views\View;
use Psr\Container\ContainerInterface;
use Router\Router\Router;

class Controller
{
    protected ContainerInterface $container;
    protected Request $request;

    public function __construct()
    {
        $this->container = Container::getInstance();
        $this->request = $this->container->get(Request::class);
    }
}
