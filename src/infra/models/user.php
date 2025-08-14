<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UserModel extends Model {
    public function create(string $name, string $email, string $password, string $username, string $date_birthday, string $token): string {
        $sql = "INSERT INTO users (id, name, email, password, username, date_birthday, token) VALUES (:id, :name, :email, :password, :username, :date_birthday, :token)";

        $id = uniqid(more_entropy: true);

        $this->database->exec($sql, [
            ":id" => $id,
            ":name" => $name,
            ":email" => $email,
            ":password" => $password,
            ":username" => $username,
            ":date_birthday" => $date_birthday,
            ":token" => $token
        ]);

        return $id;
    }

    public function getUserById(string $id) {
        $sql = "SELECT * FROM users WHERE id = :id";

        return $this->database->query($sql, [":id" => $id]);
    }

    public function getUserByEmail(string $email) {
        $sql = "SELECT * FROM users WHERE email = :email";

        return $this->database->query($sql, [":email" => $email]);
    }

    public function getUserByUsername(string $username) {
        $sql = "SELECT * FROM users WHERE username = :username";

        return $this->database->query($sql, [":username" => $username]);
    }

    public function getUserByToken(string $token) {
        $sql = "SELECT * FROM users WHERE token = :token";

        return $this->database->query($sql, [":token" => $token]);
    }

    public function verifyEmail(string $id) {
        $sql = "UPDATE users SET verified_email = 1 WHERE id = :id";

        $this->database->exec($sql, [":id" => $id]);
    }

    public function markEmailAsSent(string $id) {
        $sql = "UPDATE users SET email_already_sent = 1 WHERE id = :id";

        $this->database->exec($sql, [":id" => $id]);
    }

    
}