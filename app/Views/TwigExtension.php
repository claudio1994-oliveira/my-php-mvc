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
            new TwigFunction('error', [TwigRuntimeExtension::class, 'error']),
            new TwigFunction('errors', [TwigRuntimeExtension::class, 'errors']),
            new TwigFunction('old', [TwigRuntimeExtension::class, 'old']),
            new TwigFunction('csrf', [TwigRuntimeExtension::class, 'csrf']),
        ];
    }
}
