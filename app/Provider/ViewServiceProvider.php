<?php

namespace App\Provider;

use App\Views\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ViewServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
        $this->getContainer()->add(View::class, function () {

            $loader = new FilesystemLoader(__DIR__ . '/../../resources/views');
            $twig = new Environment($loader, [
                'cache' => false,
                'debug' => true,
            ]);

            return new View($twig);
        });
    }

    public function boot(): void
    {
    }

    public function provides(string $id): bool
    {
        $services = [
            View::class
        ];

        return in_array($id, $services);
    }
}
