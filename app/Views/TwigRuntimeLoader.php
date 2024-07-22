<?php

namespace App\Views;

use Psr\Container\ContainerInterface;
use Twig\RuntimeLoader\RuntimeLoaderInterface;

class TwigRuntimeLoader implements RuntimeLoaderInterface
{
    public function __construct(public ContainerInterface $container)
    {
    }

    public function load(string $class)
    {
        if ($class === TwigRuntimeExtension::class) {
            return new $class($this->container);
        }
    }
}
