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

    public function removeCategoryInUser(string $categoryId, string $userId)
    {
        $sql = "DELETE FROM users_category WHERE category_id = :category_id AND user_id = :user_id";

        return $this->database->exec($sql, [
            ":category_id" => $categoryId,
            ":user_id" => $userId
        ]);
    }

    public function removeAllCategoriesFromUser(string $userId)
    {
        $sql = "DELETE FROM users_category WHERE user_id = :user_id";

        return $this->database->exec($sql, [
            ":user_id" => $userId
        ]);
    }

    public function getAllCategoriesByUserId(string $userId)
    {
        $sql = "SELECT categories.* FROM categories INNER JOIN users_category ON categories.id = users_category.category_id WHERE users_category.user_id = :user_id";

        return $this->database->query($sql, [
            ":user_id" => $userId
        ]);
    }

    public function getAllCategories(): array
    {
        $sql = "SELECT * FROM categories ORDER BY name DESC";
        return $this->database->query($sql);
    }
    public function getCategories(int $offset, int $limit): array
    {
        $sql = "SELECT * FROM categories ORDER BY name DESC LIMIT $offset, $limit";
        return $this->database->query($sql);
    }

    public function createCategory(string $name): bool
    {
        $sql = "INSERT INTO categories (id, name) VALUES (:id, :name)";
        $id = uniqid(more_entropy: true);
        return $this->database->exec($sql, [":id" => $id, ":name" => $name]);
    }

    public function updateCategory(string $id, string $name): bool
    {
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        return $this->database->exec($sql, [
            ":name" => $name,
            ":id" => $id
        ]);
    }
    public function deleteCategories(string $id): bool
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        return $this->database->exec($sql, [
            ":id" => $id
        ]);
    }
}
