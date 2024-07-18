<?php

namespace App\Provider;

use App\Config\Config;
use App\Core\App;
use App\Core\Http\Session;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

class SessionServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
        $this->getContainer()->add(Session::class, function () {

            return Session::getInstance();

        });
    }

    public function boot(): void
    {

    }

    public function provides(string $id): bool
    {
        $services = [
            Session::class
        ];

        return in_array($id, $services);
    }

}