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
    
    public function getCategories(int $offset, int $limit, string $search, string $ordering): array
    {
        $sql = "SELECT * FROM categories WHERE name LIKE :name ORDER BY name $ordering LIMIT $offset, $limit";
        return $this->database->query($sql, ["name" => "%$search%"]);
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

    public function getCountVideosByCategories(){
        $sql = "
        SELECT name, total
        FROM (
            SELECT 
                c.name,
                COUNT(v.id) AS total,
                ROW_NUMBER() OVER (ORDER BY COUNT(v.id) DESC) AS rn
            FROM categories c
            LEFT JOIN videos v ON v.category_id = c.id
            GROUP BY c.id
        ) t
        WHERE rn <= 4

        UNION ALL

        SELECT
            'Outras' AS name,
            SUM(total) AS total
        FROM (
            SELECT 
                c.name,
                COUNT(v.id) AS total,
                ROW_NUMBER() OVER (ORDER BY COUNT(v.id) DESC) AS rn
            FROM categories c
            LEFT JOIN videos v ON v.category_id = c.id
            GROUP BY c.id
        ) u
        WHERE rn > 4
    ";
        return $this->database->query($sql);
    }
}
