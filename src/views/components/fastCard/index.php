<?php

namespace Src\Views\Components\FastCard;

require_once __DIR__ . "/../../../application/utils/purify/index.php";

use function Src\Application\Utils\Purify\purifyProperty;
use function Src\Application\Utils\Purify\purifyNumbers;

function FastCardComponent(array $card)
{
    $id        = purifyProperty($card['id']);
    $url       = "/VHS/home/fasts?id=" . $id;
    $thumb_url = "/VHS/public/thumbnails/" . $card['thumbnail_url'];
    $title     = purifyProperty($card['title']);
    $likes     = purifyNumbers($card['likes']);
    $views     = purifyNumbers($card['views']);

    return <<<HTML
    <a href='$url' class='group relative w-full aspect-[9/16] rounded-xl overflow-hidden bg-gray-900 block'>
        <img src='$thumb_url' 
             class='w-full h-full object-cover transition-transform duration-200 group-hover:scale-105' 
             onerror="this.src='/VHS/public/uploads/thumbs/default.png'">
        
        <div class='absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity'></div>
        
        <div class='absolute bottom-0 left-0 w-full p-4'>
            <h3 class='text-white font-bold leading-tight line-clamp-2 mb-3 drop-shadow-md'>
                $title
            </h3>

            <div class='flex items-center justify-between text-sm text-gray-200'>
                <div class='flex items-center gap-1.5'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <span>$views</span>
                </div>
                
                <div class='flex items-center gap-1.5'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>
                    <span>$likes</span>
                </div>
            </div>
        </div>
    </a>
    HTML;
}
