<?php

namespace App\Provider;

use App\Views\TwigExtension;
use App\Views\TwigRuntimeLoader;
use App\Views\View;
use Twig\Environment;
use Twig\Extension\DebugExtension;
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

            $twig->addRuntimeLoader(new TwigRuntimeLoader($this->getContainer()));

            $twig->addExtension(new TwigExtension());
            $twig->addExtension(new DebugExtension());

            return new View($twig);
        })->setShared(true);
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
