<?php

namespace App\Http\Entity;

use App\Core\Http\Repository;

class User extends Repository
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


}
