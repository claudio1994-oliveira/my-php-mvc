<?php

namespace App\Core;

use App\Contracts\RequestInterface;

class Request implements RequestInterface
{
    private $method;
    private $uri;
    private $headers;
    private $body;
    private $parsedBody;
    private $queryParams;
    private $serverParams;
    private $uploadedFiles;

    public function __construct(
        string $method,
        string $uri,
        array $headers,
        string $body,
        array $parsedBody,
        array $queryParams,
        array $serverParams,
        array $uploadedFiles
    ) {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->body = $body;
        $this->parsedBody = $parsedBody;
        $this->queryParams = $queryParams;
        $this->serverParams = $serverParams;
        $this->uploadedFiles = $uploadedFiles;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? null;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getParsedBody(): array
    {
        return $this->parsedBody;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getServerParams(): array
    {
        return $this->serverParams;
    }

    public function getUploadedFiles(): array
    {
        return $this->uploadedFiles;
    }
}
