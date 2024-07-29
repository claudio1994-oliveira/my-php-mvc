<?php

namespace App\Core\Database;

use PDO;
use PDOStatement;

class Builder
{
    private PDO $pdo;
    protected ?string $query = null;

    protected array $params = [];

    public function __construct()
    {
        $this->pdo = Connector::getInstance();
    }

    public function query(string $query, array $params = []): self
    {
        $this->query = $query;
        $this->params = $params;
        return $this;
    }

    private function executeQuery(): PDOStatement
    {
        $statement = $this->pdo->prepare($this->query);

        $this->bindParameters($statement);

        $statement->execute();

        return $statement;
    }

    private function bindParameters(PDOStatement $statement): void
    {
        if (empty($this->params)) {
            return;
        }

        foreach ($this->params as $key => $value) {
            $key = is_int($key) ? $key + 1 : $key;
            $pdoParams = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;

            $statement->bindValue($key, $value, $pdoParams);
        }
    }

    public function get(): array
    {
        return $this->executeQuery()->fetchAll(PDO::FETCH_OBJ);
    }

    public function first(): bool|object
    {
        return $this->executeQuery()->fetch(PDO::FETCH_OBJ);
    }

    public function insert(): false|string
    {
        $this->executeQuery();

        return $this->pdo->lastInsertId();
    }
}