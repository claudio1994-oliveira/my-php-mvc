<?php

namespace App\Provider;


use App\Core\Http\CSRF;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class CSRFServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function register(): void
    {
        $this->getContainer()->add(CSRF::class, function () {
            return new CSRF();
        });
    }

    public function boot(): void
    {
    }

    public function provides(string $id): bool
    {
        $services = [
            CSRF::class
        ];

        return in_array($id, $services);
    }
}
