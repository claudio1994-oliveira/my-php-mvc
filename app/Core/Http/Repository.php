<?php

namespace App\Core\Http;

class Repository
{
    public readonly int $id;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}