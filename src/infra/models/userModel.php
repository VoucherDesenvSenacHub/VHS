<?php
namespace Src\Infra\Models;

require_once __DIR__ . '/../../infra/db/database.php';
use Database;
use PDO;

class UserModel {
    private PDO $connection;

    public function __construct() {
        $this->connection = (new Database())->getConnection();
    }

    public function create(string $name, string $email, string $password, string $username, string $date_birthday): bool {
        $sql = "INSERT INTO users (id, name, email, password, username, date_birthday) VALUES (:id, :name, :email, :password, :username, :date_birthday)";

        $id = uniqid();

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":date_birthday", $date_birthday);
    
        return $stmt->execute();
    }

    public function findByEmail(string $email): array {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}