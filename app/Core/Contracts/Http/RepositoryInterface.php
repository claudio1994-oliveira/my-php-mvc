<?php

namespace App\Core\Contracts\Http;

use App\Core\Http\Entity;

interface RepositoryInterface
{
    public function all(): array;

    public function find(int $id): null|object;

    public function create(Entity $data): object;

    public function update(int $id, object $data): bool;

    public function delete(int $id): bool;
}