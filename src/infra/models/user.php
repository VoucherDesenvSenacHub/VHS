<?php

namespace Src\Infra\Models;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class UserModel extends Model {
    public function create(string $name, string $email, string $password, string $username, string $date_birthday): bool {
        $sql = "INSERT INTO users (id, name, email, password, username, date_birthday) VALUES (:id, :name, :email, :password, :username, :date_birthday)";

        $id = uniqid();

        $stmt = $this->database->exec($sql, [
            ":id" => $id,
            ":name" => $name,
            ":email" => $email,
            ":password" => $password,
            ":username" => $username,
            ":date_birthday" => $date_birthday
        ]);

        return $stmt;
    }

    public function findUserByEmail(string $email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->database->query($sql, [":email" => $email]);

        return $stmt;
    }
}