<?php

namespace App\Provider;

use App\Config\Config;
use Spatie\Ignition\Ignition;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
    }

    public function boot(): void
    {
        if ($this->getContainer()->get(Config::class)->get('app.debug')) {
            Ignition::make()->register();
        }
    }

    public function provides(string $id): bool
    {
        $services = [
            'App\Core\App'
        ];

        return in_array($id, $services);
    }
}
