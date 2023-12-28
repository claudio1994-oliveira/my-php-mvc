<?php

declare(strict_types=1);

namespace App\Contracts;

interface ControllerInterface
{
    public function processesRequest(): void;
}
