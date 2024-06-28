<?php


namespace App\Http\Controller;

use App\Core\Container;
use App\Core\Request;

class WelcomeController
{

    protected Request $request;


    public function __construct()
    {

        $this->request = Container::getInstance()->get(Request::class);
    }

    public function index()
    {

        return view('welcome.welcome', ['title' => "Bem vindo!"]);
    }
}
