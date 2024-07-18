<?php

namespace App\Core\Http;

use App\Core\Container;
use Psr\Container\ContainerInterface;

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
