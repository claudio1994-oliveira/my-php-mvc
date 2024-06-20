<?php

declare(strict_types=1);

namespace App\Controller;


class WelcomeController
{
    public function index()
    {

        return view("welcome.template", ['title' => "Bem vindo!"]);
    }
}
