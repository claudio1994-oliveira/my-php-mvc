<?php

namespace App\Provider;

use App\Core\Database\Builder;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class BuilderServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function boot(): void
    {
        // TODO: Implement boot() method.
    }

    public function provides(string $id): bool
    {
        $services = [
            Builder::class
        ];

        return in_array($id, $services);
    }

    public function register(): void
    {
        $this->getContainer()->add(Builder::class, function () {
            return new Builder();
        })->setShared(true);
    }
}