<?php

namespace App\Repository;

use App\Entity\User;
use PDO;

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(User $user)
    {
        $sql = 'INSERT INTO users (name, username) VALUES (?, ?)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->name);
        $statement->bindValue(2, $user->username);

        $result = $statement->execute();
        $id = $this->pdo->lastInsertId();

        $user->setId(intval($id));

        return $result;
    }

    public function all()
    {
        $sql = 'SELECT * FROM users;';

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement;
    }

    public function findByUsername(string $username)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE username = ?;');
        $statement->bindValue(1, $username);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
