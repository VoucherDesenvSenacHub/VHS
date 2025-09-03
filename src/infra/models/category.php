<?php

namespace Src\Infra\Model;

use Src\Application\Core\Model;

require_once __DIR__ . '/../../application/core/model.php';

class CategoryModel extends Model
{
    public function findById(string $id): array
    {
        $category = $this->database->query("SELECT * FROM categories WHERE id = :id", [
            ":id" => $id
        ]);
        return $category[0] ?? [];
    }

    public function findByName(string $name): array
    {
        $category = $this->database->query("SELECT * FROM categories WHERE name = :name", [
            ":name" => $name
        ]);
        return $category[0] ?? [];
    }

    public function addCategoryInUser(string $categoryId, string $userId): bool
    {
        $sql = "INSERT INTO users_category VALUES (:id, :category_id, :user_id)";
        $id = uniqid(more_entropy: true);
        return $this->database->exec($sql, [
            ":id" => $id,
            ":category_id" => $categoryId,
            ":user_id" => $userId
        ]);
    }

    public function getAllCategories(): array
    {
        $sql = "SELECT * FROM categories ORDER BY name DESC";
        return $this->database->query($sql);
    }

    public function createCategories(string $name): bool
    {
        $sql = "INSERT INTO categories (id, name) VALUES (:id, :name)";
        $id = uniqid(more_entropy: true);
        return $this->database->exec($sql, [":id" => $id, ":name" => $name]);
    }

    public function updateCategories(string $id, string $name): bool
    {
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        return $this->database->exec($sql, [
            ":name" => $name,
            ":id" => $id
        ]);
    }
}