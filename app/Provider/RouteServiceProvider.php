<?php

namespace App\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Router\Router\Router;

class RouteServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function register(): void
    {
        $this->getContainer()->add(Router::class, function () {

            $routes = require __DIR__ . '/../../routes/routes.php';


            return $routes->run();
        });
    }




    public function boot(): void
    {
    }

    public function provides(string $id): bool
    {
        $services = [
            Router::class
        ];

        return in_array($id, $services);
    }
}
