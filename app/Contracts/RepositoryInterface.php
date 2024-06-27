<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function all(): array;

    public function find(int $id): null|object;

    public function create(object $data): object;

    public function update(int $id, object $data): bool;

    public function delete(int $id): bool;
}