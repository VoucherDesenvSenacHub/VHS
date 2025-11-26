<?php
namespace Src\Views\Components;


function GetHistoryByFilter(object $userHistoryModel, string $userId, string $filter): array

{
    switch ($filter) {
        case 'videos':
         
            return $userHistoryModel->getHistoryByUserId($userId, 'VIDEO');

        case 'fasts':
            
            return $userHistoryModel->getHistoryByUserId($userId, 'FAST');

        case 'events':
            
            return $userHistoryModel->getHistoryByUserId($userId, 'Event');

        default:
            return [];
    }
}

?>