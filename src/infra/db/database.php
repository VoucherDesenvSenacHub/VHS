<?php

class Database {
    private string $driver;
    private string $host;
    private string $database_name;
    private string $user;
    private string $password;
    private PDO $connection;
    

    public function __construct() {
        $this->driver = getenv('DB_DRIVER') ?? 'mysql';
        $this->host = getenv('DB_HOST') ?? 'localhost';
        $this->database_name = getenv('DB_DATABASE') ?? 'vhs_dev_db';
        $this->user = getenv('DB_USER') ?? 'root';
        $this->password = getenv('DB_PASSWORD') ?? '';

        $this->connection = new PDO("{$this->driver}:host={$this->host};dbname={$this->database_name}", $this->user, $this->password);
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}
