<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class FastLikeModel extends Model {

   public function addLike($likedBy, $fastId) {
        $id = uniqid(more_entropy: true);

        $sql = "INSERT INTO fast_likes (id, liked_by, fast_id) VALUES (:id, :liked_by, :fast_id)";
        $this->database->exec($sql, [
            ":id" => $id, 
            ":liked_by" => $likedBy,
            ":fast_id" => $fastId
        ]);
   }

   public function removeLike($likedBy, $fastId) {
        $sql = "DELETE FROM fast_likes WHERE liked_by = :liked_by AND fast_id = :fast_id";
        $this->database->exec($sql, [
            ":liked_by" => $likedBy,
            ":fast_id" => $fastId
        ]);
   }

   public function countLikes(string $fastId): int {
        $sql = "SELECT COUNT(*) as total FROM fast_likes WHERE fast_id = :fast_id";
        $result = $this->database->query($sql, [
            ":fast_id" => $fastId
        ]);
        return isset($result[0]['total']) ? (int)$result[0]['total'] : 0;
   }

   public function getLikeByUserAndFast(string $userId, string $fastId) {
        $sql = "SELECT * FROM fast_likes WHERE liked_by = :liked_by AND fast_id = :fast_id";
        return $this->database->query($sql, [
            ":liked_by" => $userId,
            ":fast_id" => $fastId
        ]);
   }
}
