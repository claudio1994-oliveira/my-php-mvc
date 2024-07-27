<?php

namespace App\Core\Contracts\Http;

interface ResponseInterface
{
    public function getStatusCode(): int;

    public function getReasonPhrase(): string;

    public function getHeaders(): array;

    public function getHeader(string $name): ?string;

    public function getBody(): string;

    public function withStatus(int $code, string $reasonPhrase = ''): self;

    public function withHeader(string $name, string $value): self;

    public function writeBody(string $data): void;
}
