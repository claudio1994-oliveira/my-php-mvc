<?php

namespace App\Provider;

use App\Config\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ConfigServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
        $this->getContainer()->add(Config::class, function () {

            $config = new Config();

            return $this->mergeConfigFromFiles($config);
        });
    }

    protected function mergeConfigFromFiles(Config $config): Config
    {
        $path = __DIR__ . '/../../config';

        foreach (array_diff(scandir($path), ['.', '..']) as $file) {
            $config->merge([
                explode('.', $file)[0] => require($path . '/' . $file)
            ]);
        }

        return $config;
    }


    public function boot(): void
    {
    }

    public function provides(string $id): bool
    {
        $services = [
            Config::class
        ];

        return in_array($id, $services);
    }
}
