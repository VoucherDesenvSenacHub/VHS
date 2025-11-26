<?php
    function getAuthor(object $userModel, ?string $authorId): array
    {
        if (!$authorId){
             return [];
        }
        $authorData = $userModel->getUserById($authorId);

        return $authorData[0] ?? [];
    }

?>
