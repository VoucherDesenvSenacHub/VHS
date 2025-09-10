<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UserModel extends Model {
    public function create(string $name, string $email, string $password, string $username, string $date_birthday, string $token): string {
        $sql = "INSERT INTO users (id, name, email, password, username, date_birthday, token) VALUES (:id, :name, :email, :password, :username, :date_birthday, :token)";

        $id = uniqid(more_entropy: true);

        $stmt = $this->database->exec($sql, [
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

    public function getUserById(string $id): array {
        $sql = "SELECT * FROM users WHERE id = :id";

        return $this->database->query($sql, [":id" => $id]);
    }

    public function getUserByEmail(string $email): array {
        $sql = "SELECT * FROM users WHERE email = :email";

        return $this->database->query($sql, [":email" => $email]);
    }

    public function getUserByUsername(string $username): array {
        $sql = "SELECT * FROM users WHERE username = :username";

        return $this->database->query($sql, [":username" => $username]);
    }

    public function getUserByToken(string $token): array {
        $sql = "SELECT * FROM users WHERE token = :token";

        return $this->database->query($sql, [":token" => $token]);
    }

    public function findUserByEmail(string $email): array {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->database->query($sql, [":email" => $email]);

        return $stmt;
    }

    public function updateUserToken(string $id, string $token): bool {
        $sql = "UPDATE users SET token = :token WHERE id = :id";
        return $this->database->exec($sql, [":token" => $token, ":id" => $id]);
    }

    public function updateUser(string $userId, string $name, string $email, string $username, ?string $password = null, ?string $avatar): bool {
        $sql = "UPDATE users SET name = :name, email = :email, username = :username" . ($password ? ", password = :password" : "") . ", avatar_url = :avatar_url WHERE id = :id";    
        
        return $this->database->exec($sql, [
            ":name" => $name,
            ":email" => $email,
            ":username" => $username,
            ...( $password ? [":password" => $password] : [] ),
            ":avatar_url" => $avatar ?? null,
            ":id" => $userId
        ]);
    }

    public function updateSentEmailStatus(string $id, bool $status): bool {
        $sql = "UPDATE users SET email_already_sent = :status  WHERE id = :id";
        return $this->database->exec($sql, [":id" => $id, ":status" => $status]);
    }

    public function verifyEmail(string $id): bool {
        $sql = "UPDATE users SET verified_email = true WHERE id = :id";
        return $this->database->exec($sql, [":id" => $id]);
    }

    public function getCategoryByUserId(string $id): array {
        $sql = "SELECT * FROM users_category WHERE user_id = :id";
    
        return $this->database->query($sql, [":id" => $id]);    
    }
    public function resetpassword(string $email, string $newPassword): bool {
        $sql = "UPDATE users SET password = :password WHERE email = :email";

        $stmt = $this->database->exec($sql, [
            ":password" => $newPassword,
            ":email" => $email
        ]);

        return $stmt;
    }
}