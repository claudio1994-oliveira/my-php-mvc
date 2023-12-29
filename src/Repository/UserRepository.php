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
        $sql = 'INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?);';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->name);
        $statement->bindValue(2, $user->username);
        $statement->bindValue(3, $user->email);
        $statement->bindValue(4, $user->password);

        $result = $statement->execute();
        $id = $this->pdo->lastInsertId();

        $user->setId(intval($id));

        return $result;
    }

    public function update(User $user)
    {
        $sql = 'UPDATE users SET name = ?, username = ?, email = ?, password = ? WHERE id = ?;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->name);
        $statement->bindValue(2, $user->username);
        $statement->bindValue(3, $user->email);
        $statement->bindValue(4, $user->password);
        $statement->bindValue(5, $user->id);

        return $statement->execute();
    }

    public function remove(User $user)
    {
        $sql = 'DELETE FROM users WHERE id = ?;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->id);

        return $statement->execute();
    }

    public function all()
    {
        $sql = 'SELECT * FROM users;';

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);;
    }

    public function findByUsername(string $username)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE username = ?;');
        $statement->bindValue(1, $username);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function find(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = ?;');
        $statement->bindValue(1, $id);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
