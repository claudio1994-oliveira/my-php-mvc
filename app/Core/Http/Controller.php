<?php

namespace App\Core\Http;

use App\Core\Container;
use Psr\Container\ContainerInterface;

class Controller
{
    protected ContainerInterface $container;
    protected Request $request;
    protected Session $session;

    public function __construct()
    {
        $this->container = Container::getInstance();
        $this->request = $this->container->get(Request::class);
        $this->session = $this->container->get(Session::class);
    }
}
