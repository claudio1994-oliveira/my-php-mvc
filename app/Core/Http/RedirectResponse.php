<?php

namespace App\Core\Http;

use JetBrains\PhpStorm\NoReturn;

class RedirectResponse extends Response
{
    public function __construct(string $url, int $statusCode = 302, string $reasonPhrase = '', array $headers = [])
    {
        $headers['Location'] = $url;
        parent::__construct($statusCode, $reasonPhrase, $headers);
    }

    #[NoReturn] public function dispatch(): Response
    {
        header("Location: " . $this->getHeader('Location'), true, $this->getStatusCode());
        exit;
    }
}