<?php

namespace App\Core;

use App\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    private $statusCode;
    private $reasonPhrase;
    private $headers;
    private $body;

    public function __construct(int $statusCode = 200, string $reasonPhrase = '', array $headers = [], string $body = '')
    {
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
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

    public function withStatus(int $code, string $reasonPhrase = ''): self
    {
        $new = clone $this;
        $new->statusCode = $code;
        $new->reasonPhrase = $reasonPhrase;
        return $new;
    }

    public function withHeader(string $name, string $value): self
    {
        $new = clone $this;
        $new->headers[$name] = $value;
        return $new;
    }

    public function writeBody(string $data): void
    {
        $this->body .= $data;
    }

    public function dispatch(): void
    {
        echo $this->body;
    }
}
