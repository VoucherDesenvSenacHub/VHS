<?php

namespace Src\Views\Components\VideoCard;

require_once __DIR__ . "/../../../application/utils/purify/index.php";

use function Src\Application\Utils\Purify\purifyProperty;
use function Src\Application\Utils\Purify\purifyNumbers;
use function Src\Application\Utils\Purify\purifyDuration;
use function Src\Application\Utils\Purify\purifyCreatedAt;

function VideoCardComponent(array $card)
{
    $id         = purifyProperty($card["id"]);
    $views      = purifyNumbers($card['views']);
    $thumb_url  = purifyProperty($card['thumbnail_url']);
    $name       = purifyProperty($card['username']);
    $avatar_url = purifyProperty($card['avatar_url']);
    $title      = purifyProperty($card['title']);
    $duration   = purifyDuration($card['duration']);
    $created_at = purifyCreatedAt($card['created_at']);

    if (strpos($avatar_url, '/') === false) {
        $avatar_url = "/VHS/public/uploads/avatars/" . $avatar_url;
    }

    return <<<HTML
    <div class='flex flex-col gap-3 w-full'>
        <a href='/VHS/home/video?id=$id' class='relative w-full aspect-video rounded-xl overflow-hidden group bg-gray-800'>
            <img src='$thumb_url' 
                 class='w-full h-full object-cover transition-transform duration-200 group-hover:scale-105' 
                 onerror="this.src='/VHS/public/uploads/thumbs/default.png'">
            <div class='absolute bottom-2 right-2 bg-black/80 px-2 py-1 rounded text-xs text-white font-medium'>
                $duration
            </div>
        </a>

        <div class='flex gap-3 items-start'>
            <a href='/VHS/home/channel?username=$name' class='flex-shrink-0 group'>
                <img src='$avatar_url' 
                     class='w-9 h-9 rounded-full object-cover border border-transparent group-hover:border-purple-500 transition-all' 
                     onerror="this.src='/VHS/public/uploads/avatars/default.png'">
            </a>

            <div class='flex flex-col min-w-0'>
                <a href='/VHS/home/video?id=$id' class='text-white font-semibold leading-tight line-clamp-2 mb-1 hover:text-purple-400 transition-colors' title='$title'>
                    $title
                </a>

                <a href='/VHS/home/channel?username=$name' class='text-gray-400 text-sm hover:text-white transition-colors truncate'>
                    $name
                </a>

                <div class='text-gray-400 text-sm truncate'>
                    $views visualizações • $created_at
                </div>
            </div>
        </div>
    </div>
    HTML;
}
