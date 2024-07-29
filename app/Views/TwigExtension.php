<?php

namespace App\Views;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('config', [TwigRuntimeExtension::class, 'config']),
            new TwigFunction('auth', [TwigRuntimeExtension::class, 'auth']),
            new TwigFunction('user', [TwigRuntimeExtension::class, 'user']),
            new TwigFunction('session', [TwigRuntimeExtension::class, 'session']),
        ];
    }
}