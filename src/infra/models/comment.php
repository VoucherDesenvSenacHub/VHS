<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class CommentModel extends Model {

    public function getReportComments(int $offset, int $limit, string $ordering) {
        $sql = "SELECT * FROM report_comments WHERE is_deleted = 0 ORDER BY created_at $ordering LIMIT $offset, $limit";
        return $this->database->query($sql);
    } 

    public function getCommentById(string $id) {
        $sql = "SELECT * FROM comments WHERE id = :id";
        return $this->database->query($sql, [":id" => $id]);
    }

    public function deleteComment(string $id) {
        $sql = "UPDATE comments SET is_deleted = 1 WHERE id = :id";
        return $this->database->exec($sql, [":id" => $id]);
    }

    public function deleteReportComment( string $id) {
        $sql = "UPDATE report_comments SET is_deleted = 1 WHERE id = :id";
        return $this->database->exec($sql, [":id" => $id]);
    }
    public function getCommentsByVideoId(string $videoId, int $offset = 0, int $limit = 7, string $order = "DESC") {
        $sql = "SELECT comments.*, users.avatar_url, users.username FROM comments INNER JOIN users ON users.id = comments.user_id WHERE video_id = :video_id AND comments.is_deleted = 0 AND users.is_deleted = 0 ORDER BY created_at $order LIMIT $offset, $limit";
        return $this->database->query($sql, [":video_id" => $videoId]);
    }

    public function getTotalCommentsByVideoId(string $videoId) {
        $sql = "SELECT COUNT(*) as total FROM comments WHERE video_id = :video_id";
        return $this->database->query($sql, [":video_id" => $videoId]);
    }

    public function createComment(string $content, string $videoId, string $userId) {
        $sql = "INSERT INTO comments(id, content, video_id, user_id) VALUE (:id, :content, :video_id, :user_id)";

        return $this->database->query($sql, [":id" => uniqid(), ":content"=> $content,":video_id" => $videoId,":user_id"=> $userId]);
    }
}
