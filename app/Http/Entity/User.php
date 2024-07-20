<?php

namespace App\Http\Entity;

use App\Core\Http\Entity;

class User extends Entity
{
    public function __construct(
        public readonly string  $name,
        public readonly string  $username,
        public readonly string  $email,
        public readonly string  $password,
        public readonly ?string $created_at = null,
        public readonly ?string $updated_at = null
    )
    {
    }

    public function verifyPassword($password): bool
    {
        return password_verify($password, $this->password);
    }

}
