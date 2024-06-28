<?php

namespace App\Contracts;

interface RequestInterface
{
    public function getMethod(): string;
    public function getUri(): string;
    public function getHeaders(): array;
    public function getHeader(string $name): ?string;
    public function getBody(): string;
    public function getParsedBody(): array;
    public function getQueryParams(): array;
    public function getServerParams(): array;
    public function getUploadedFiles(): array;
}
