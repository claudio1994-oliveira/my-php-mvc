<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contracts\ControllerInterface;

class WelcomeController implements ControllerInterface
{
    public function processesRequest(): void
    {
        require_once __DIR__ . '/../../views/template.php';
    }
}
