<?php


namespace App\Controller;

use App\Views\View;
use App\Core\Container;

class WelcomeController
{

    protected View $view;
    public function __construct()
    {
        $this->view = Container::getInstance()->get(View::class);
    }

    public function index()
    {
        return $this->view->render("welcome.welcome", ['title' => "Bem vindo!"]);
    }
}
