<?php

namespace App\Entity;

class User
{
    public  int $id;
    public string $name;
    public string $username;

    public function __construct(string $name, string $username)
    {
        $this->name = $name;
        $this->username = $username;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
