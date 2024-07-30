<?php

namespace App\Core\Http;

use App\Core\Container;
use Psr\Container\ContainerInterface;
use Router\Http\Request;

class Controller
{
    protected ContainerInterface $container;
    protected Request $request;
    protected Session $session;

    protected Validator $validator;

    public function __construct()
    {
        $this->container = Container::getInstance();
        $this->request = $this->container->get(Request::class);
        $this->session = $this->container->get(Session::class);

        $this->validator = new Validator();
    }
}
