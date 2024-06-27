<?php

namespace App\Repository;

use App\Contracts\RepositoryInterface;
use App\Entity\User;
use PDO;

class UserRepository implements RepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(object $user): object
    {
        $sql = 'INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?);';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->name);
        $statement->bindValue(2, $user->username);
        $statement->bindValue(3, $user->email);
        $statement->bindValue(4, $user->password);

        $result = $statement->execute();
        if (!$result) {
            throw new \RuntimeException('Could not save user');
        }

        $id = $this->pdo->lastInsertId();

        $user->setId(intval($id));

        return $user;
    }

    public function update(int $id, object $user): bool
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

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM users WHERE id = ?;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);

        return $statement->execute();
    }

    public function all(): array
    {
        $sql = 'SELECT * FROM users;';

        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByUsername(string $username)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE username = ?;');
        $statement->bindValue(1, $username);
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function find(int $id): null|object
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = ?;');
        $statement->bindValue(1, $id);
        $statement->execute();

        $userArr = $statement->fetch(\PDO::FETCH_ASSOC);
        $user = new User($userArr['name'], $userArr['username'], $userArr['email'], $userArr['password'], $userArr['created_at'], $userArr['updated_at']);

        return $user;
    }

}
