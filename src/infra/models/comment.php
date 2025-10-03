<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class CommentModel extends Model {

    public function getReportComments(int $offset, int $limit) {
        $sql = "SELECT * FROM report_comments WHERE is_deleted = 0 ORDER BY created_at ASC LIMIT $offset, $limit";
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
}
