<?php


namespace App\Http\Controller;

use App\Views\View;
use App\Core\Container;
use App\Core\Request;
use App\Core\Response;

class WelcomeController
{

    protected View $view;
    protected Request $request;
    protected Response $response;

    public function __construct()
    {
        $this->view = Container::getInstance()->get(View::class);
        $this->request = Container::getInstance()->get(Request::class);

        $this->response = new Response();
    }

    public function index()
    {
        $this->response->withHeader('Content-Type', 'text/html');

        $this->response->writeBody($this->view->render("welcome.welcome", ['title' => "Bem vindo!"]));

        return $this->response->dispatch();
    }
}
