<?php

namespace App\Repository;

use App\Core\Contracts\Http\RepositoryInterface;
use App\Core\Database\Builder;
use App\Core\Database\Connector;
use App\Core\Http\Entity;
use App\Http\Entity\User;
use PDO;
use RuntimeException;

class UserRepository implements RepositoryInterface
{
    private PDO $pdo;
    private Builder $builder;

    public function __construct()
    {
        $this->pdo = Connector::getInstance();
        $this->builder = app(Builder::class);
    }

    /** @var User $data */
    public function create(Entity $data): object
    {
        $result = $this->builder
            ->query('INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?);',
                [
                    $data->name,
                    $data->username,
                    $data->email,
                    password_hash($data->password, PASSWORD_ARGON2ID)
                ])->insert();

        if (!$result) {
            throw new RuntimeException('Could not save user');
        }


        $data->setId(intval($result));

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

    public function findByEmail(string $email): ?User
    {
        $user = $this->builder->query("SELECT * FROM users WHERE email = ?;", [$email])->first();

        if ($user) {
            return new User($user->name,
                $user->username,
                $user->email,
                $user->password,
                $user->created_at,
                $user->updated_at
            );
        }
        return null;
    }

    public function find(int $id): null|object
    {
        $user = $this->builder->query('SELECT * FROM users WHERE id = ?;', [$id])->first();

        if ($user) {
            return new User($user->name,
                $user->username,
                $user->email,
                $user->password,
                $user->created_at,
                $user->updated_at
            );
        }
        return null;
    }


}
