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

    private Validator $validator;

    public function __construct()
    {
        $this->container = Container::getInstance();
        $this->request = $this->container->get(Request::class);
        $this->session = $this->container->get(Session::class);

        $this->validator = new Validator();
    }

    public function validate(array $rules, array $messages = []): null|RedirectResponse
    {

        $this->validator->validate($this->request->getParsedBody(), $rules, $messages);


        if ($this->validator->hasErrors()) {
            
            $url = $this->request->getHeader('Referer');

            return redirect($url);
        }

        return null;
    }
}
