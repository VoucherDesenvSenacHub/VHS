<?php

namespace Src\Application\Core;
use PDO;
use PDOStatement;

class Database {
    private string $driver;
    private string $host;
    private string $database_name;
    private string $user;
    private string $password;
    private PDO $database;
    

    public function __construct() {

        $this->driver = $_ENV['DB_DRIVER'] ?? 'mysql';
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->database_name = $_ENV['DB_DATABASE'] ?? 'vhs_dev_db';
        $this->user = $_ENV['DB_USER'] ?? 'root';
        $this->password = $_ENV['DB_PASSWORD'] ?? '';

        $dsn = "{$this->driver}:host={$this->host};dbname={$this->database_name}";

        $this->database = new PDO($dsn, $this->user, $this->password);
    }

    public function getDatabase(): PDO {
        return $this->database;
    }

    public function query(string $sql, array $params = []): bool {
        $stmt = $this->database->prepare($sql);
        return $stmt->execute($params);
    }
}
