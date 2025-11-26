<?php

namespace Src\Infra\Model;

require_once __DIR__ . "/../../application/core/model.php";
require_once __DIR__ . '/../../application/core/database.php';

use Src\Application\Core\Model;

class VideoModel extends Model
{

    public function create(string $url, string $title, string $description = '', string $category_id, string $author_id, string $thumbnail_url)
    {

        $sql = "INSERT INTO videos(id, url, title, description, author_id, category_id, thumbnail_url, created_at) VALUES(:id, :url, :title, :description, :author_id, :category_id, :thumbnail_url, :created_at)";

        $id = uniqid();
        $created_at = (new \DateTime('now', new \DateTimeZone('UTC')))->format('Y-m-d H:i:s');

        $stmt = $this->database->query($sql, [
            ":id" => $id,
            ":url" => $url,
            ":title" => $title,
            ":description" => $description,
            ":author_id" => $author_id,
            ":category_id" => $category_id,
            ":thumbnail_url" => $thumbnail_url,
            ":created_at" => $created_at
        ]);

        return $stmt;
    }

    public function update(string $id, string $title, string $description, string $category_id, string $thumbnail_url)
    {
        $sql = "UPDATE videos SET title = :title, description = :description, category_id = :category_id, thumbnail_url = :thumbnail_url WHERE id = :id";

        $stmt = $this->database->query($sql, [
            ":id" => $id,
            ":title" => $title,
            ":description" => $description,
            ":category_id" => $category_id,
            ":thumbnail_url" => $thumbnail_url
        ]);

        return $stmt;
    }

    public function delete($id)
    {
        $sql = "UPDATE videos SET is_deleted = 1 WHERE id = :id";

        return $this->database->query($sql, [":id" => $id]);
    }


    public function incrementViewCount($videoId)
    {
        $sql = "UPDATE videos SET views = views + 1 WHERE id = :video_id";
        return $this->database->query($sql, ["video_id" => $videoId]);
    }

    public function getVideoByTitle(string $query, int $offset = 0, int $limit = 8): array
    {
        $sql = "SELECT * FROM videos WHERE (title LIKE :query) LIMIT $offset, $limit";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }

    public function getFastByTitle(string $query): array
    {
        $sql = "SELECT * FROM videos WHERE (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }

    public function getPopularVideos(int $offset = 0, int $limit = 7): array
    {
        $sql = "SELECT videos.id, url, title, description, duration, views, thumbnail_url, videos.created_at, videos.update_at, username, avatar_url FROM videos INNER JOIN users ON videos.author_id = users.id ORDER BY views DESC LIMIT $offset, $limit";

        return $this->database->query($sql);
    }

    public function getVideosByCategory(string $categoryId, int $offset = 0, int $limit = 4): array
    {
        $sql = "SELECT videos.id, url, title, description, duration, views, thumbnail_url, videos.created_at, videos.update_at, username, avatar_url FROM videos INNER JOIN users ON videos.author_id = users.id WHERE videos.category_id = :category_id ORDER BY created_at ASC LIMIT $offset, $limit";

        return $this->database->query($sql, [":category_id" => $categoryId]);
    }

    public function getVideoById(string $id): array
    {
        $sql = "SELECT videos.*, users.username, users.followers,  users.avatar_url, categories.name as category_name FROM videos
    public function getVideoById(string $id): array {
        $sql = "SELECT videos.*, users.username, users.avatar_url, categories.name as category_name FROM videos
        JOIN users ON users.id = videos.author_id
        JOIN categories ON categories.id = videos.category_id
        WHERE videos.id = :id";

        return $this->database->query($sql, [":id" => $id]);
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";

        return $this->database->query($sql);
    }

    public function getAllVideos(string $author_id, int $offset = 0, int $limit = 8): array
    {
        $sql = "SELECT 
            v.*, 
            COUNT(DISTINCT c.id) AS comments,
            CAST(ROUND(AVG(v_ava.stars), 2) AS DECIMAL(10,2)) AS avaliations
        FROM 
            videos v
        LEFT JOIN 
            comments c ON c.video_id = v.id AND c.is_deleted = 0
        LEFT JOIN
            videos_avaliations v_ava ON v_ava.video_id = v.id AND v_ava.is_deleted = 0
        WHERE 
            v.is_deleted = 0 AND author_id = :author_id
        GROUP BY 
            v.id
        ORDER BY 
            v.created_at DESC
        LIMIT $offset, $limit
    ";

        return $this->database->query($sql, [":author_id" => $author_id]);
    }

    public function countVideos(string $author_id): int
    {
        $sql = "SELECT COUNT(*) as total FROM videos WHERE is_deleted = 0 AND author_id = :author_id";
        $stmt = $this->database->query($sql, [":author_id" => $author_id]);
        return (int)$stmt[0]['total'];
    }

    public function getVideoStudioByID(string $id): array
    {
        $sql = "SELECT 
            v.*, 
            COUNT(c.id) AS comments
        FROM 
            videos v
        LEFT JOIN 
            comments c ON c.video_id = v.id AND c.is_deleted = 0
        WHERE 
            v.is_deleted = 0 AND v.id = :id
    ";

        $stmt = $this->database->query($sql, [":id" => $id]);

        return $stmt[0];
    }
}

    
    public function getAllViewsByUserId(string $userId): array {
        $sql = "SELECT SUM(videos.views) as views, AVG(videos.views) as average FROM videos WHERE author_id = :userId";
        return $this->database->query($sql, [":userId"=> $userId]);
    }

    public function getAverageAvailableVideosByUserId(string $userId): array {
        $sql = "SELECT AVG(videos_avaliations.stars) as average FROM videos_avaliations
        JOIN videos ON videos.id = videos_avaliations.video_id
        WHERE videos.author_id = :userId";
        return $this->database->query($sql, [":userId"=> $userId]);
    }

    public function getLastVideosByUserId(string $userId, int $offset, int $limit) {
        $sql = "SELECT * FROM videos WHERE author_id = :userId AND is_deleted = 0 ORDER BY created_at DESC LIMIT $offset, $limit";
        return $this->database->query($sql, [":userId" => $userId]);
    }

    public function getViewsCountByWeekDay(string $userId){
        $sql = "SELECT DAYNAME(users_history.created_at) AS day_name, COUNT(*) AS total_views FROM users_history
        JOIN videos ON videos.id = users_history.video_id
        WHERE videos.author_id = :userId AND YEARWEEK(users_history.created_at, 1) = YEARWEEK(CURDATE(), 1)
        GROUP BY DAYOFWEEK(users_history.created_at)
        ORDER BY DAYOFWEEK(users_history.created_at)";
        return $this->database->query($sql, [":userId" => $userId]);
    }

}