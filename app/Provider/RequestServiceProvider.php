<?php

namespace App\Provider;

use Router\Http\Request;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class RequestServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->getContainer()->add(Request::class, function () {
            $method = $_SERVER['REQUEST_METHOD'];
            $uri = $_SERVER['REQUEST_URI'];
            $headers = getallheaders();
            $body = file_get_contents('php://input');
            $parsedBody = $_POST;
            $queryParams = $_GET;
            $serverParams = $_SERVER;
            $uploadedFiles = $_FILES;

            return new Request($method, $uri, $headers, $body, $parsedBody, $queryParams, $serverParams, $uploadedFiles);

        })->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            Request::class
        ];

        return in_array($id, $services);
    }
}
