<?php

namespace App\Entity;

class User
{
    public  int $id;
    public string $name;
    public string $username;

    public string $email;

    public string $password;

    public ?string $created_at;

    public ?string $updated_at;

    public function __construct(string $name, string $username, string $email, string $password, ?string $created_at = null, ?string $updated_at = null)
    {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
