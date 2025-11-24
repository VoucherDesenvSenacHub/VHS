<?php

namespace Src\Views\Components\Utils;
require_once __DIR__ . "/../../../../application/utils/getTimeAgo.php";
use function Src\Application\Utils\getTimeAgo;

function CommentStudioAnalytics(string $name, string $text, ?string $created_at = null, ?string $userImg = null)  {
    $timeAgo = getTimeAgo($created_at);
    return 
        <<<HTML
        <div class='w-full flex gap-4 py-2'>
            <div class='w-14 h-14 mt-1 shrink-0'>
                <img class='rounded-full' src='/VHS/public/uploads/avatars/{$userImg}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
            </div>
    
            <div class='flex flex-col flex-1'>
                <div class='flex items-baseline gap-3'>
                    <p class='text-lg text-white font-semibold'>$name</p> 
                    <p class='text-sm text-white'>$timeAgo</p>
                </div>
    
                <div class='mt-1 text-xs font-semibold text-gray-400 max-w-xl'>
                    <p>$text</p>
                </div>
            </div>
        </div>
        HTML;

}
