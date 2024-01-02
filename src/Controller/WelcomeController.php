<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contracts\ControllerInterface;

class WelcomeController implements ControllerInterface
{
    public function processesRequest(): void
    {
        view("welcome.template", ['title' => "Bem vindo!"]);
    }
}
