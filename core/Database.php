<?php

namespace PHPFramework;

class Database
{

    protected \PDO $connection;
    protected \PDOStatement $stmt;

    public function __construct()
    {
        $dsn = "mysql:host=" . DB_SETTINGS['host'] . ";dbname=" . DB_SETTINGS['database'] . ";charset=" . DB_SETTINGS['charset'];
        try {
            $this->connection = new \PDO($dsn, DB_SETTINGS['username'], DB_SETTINGS['password'], DB_SETTINGS['options']);
        } catch (\PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] DB Error: {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
            abort('DB error connection', 500);
        }
        return $this;
    }

    public function query(string $query, array $params = []): static
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }

    public function get(): array|false
    {
        return $this->stmt->fetchAll();
    }

    public function getAssoc($key = 'id'): array
    {
        $data = [];
        while ($row = $this->stmt->fetch()) {
            $data[$row[$key]] = $row;
        }
        return $data;
    }

    public function getOne()
    {
        return $this->stmt->fetch();
    }

    public function getColumn()
    {
        return $this->stmt->fetchColumn();
    }

    public function findAll($tbl): array|false
    {
        $this->query("select * from {$tbl}");
        return $this->stmt->fetchAll();
    }

    public function findOne($tbl, $value, $key = 'id')
    {
        $this->query("select * from {$tbl} where $key = ? LIMIT 1", [$value]);
        return $this->stmt->fetch();
    }

    public function findOrFail($tbl, $value, $key = 'id')
    {
        $res = $this->findOne($tbl, $value, $key);
        if (!$res) {
            if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
                response()->json(['status' => 'error', 'answer' => 'Not found'], 404);
            }
            abort();
        }
        return $res;
    }

    public function getInsertId(): false|string
    {
        return $this->connection->lastInsertId();
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }

    public function commit(): bool
    {
        return $this->connection->commit();
    }

    public function rollBack(): bool
    {
        return $this->connection->rollBack();
    }


}