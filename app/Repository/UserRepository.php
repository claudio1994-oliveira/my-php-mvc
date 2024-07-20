<?php

namespace App\Repository;

use App\Contracts\RepositoryInterface;
use App\Core\Database\Connector;
use App\Core\Http\Entity;
use App\Http\Entity\User;
use PDO;
use RuntimeException;

class UserRepository implements RepositoryInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connector::getInstance();
    }

    /** @var User $data */
    public function create(Entity $data): object
    {

        $sql = 'INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?);';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $data->name);
        $statement->bindValue(2, $data->username);
        $statement->bindValue(3, $data->email);
        $statement->bindValue(4, password_hash($data->password, PASSWORD_ARGON2ID));

        $result = $statement->execute();
        if (!$result) {
            throw new RuntimeException('Could not save user');
        }

        $id = $this->pdo->lastInsertId();

        $data->setId(intval($id));

        return $data;
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

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByEmail(string $email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = ?;');
        $statement->bindValue(1, $email);
        $statement->execute();

        $userArr = $statement->fetch(PDO::FETCH_ASSOC);
        if ($userArr) {
            return new User($userArr['name'], $userArr['username'], $userArr['email'], $userArr['password'], $userArr['created_at'], $userArr['updated_at']);

        }
        return null;
    }

    public function find(int $id): null|object
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = ?;');
        $statement->bindValue(1, $id);
        $statement->execute();

        $userArr = $statement->fetch(PDO::FETCH_ASSOC);
        $user = new User($userArr['name'], $userArr['username'], $userArr['email'], $userArr['password'], $userArr['created_at'], $userArr['updated_at']);

        return $user;
    }

    public function findByEmailAndPassword(string $email, string $password)
    {
        $hash = password_hash($password, PASSWORD_ARGON2ID);

        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = ? AND password = ?;');
        $statement->bindValue(1, $email);
        $statement->bindValue(2, $hash);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}
