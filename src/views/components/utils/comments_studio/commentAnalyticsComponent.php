<?php

namespace Src\Views\Components\Utils;

function CommentStudioAnalytics(string $name, string $text, ?string $created_at = null, ?string $userImg = null, string $videoId, ?string $thumbnailURL = null)  {
    

    return 
        <<<HTML
        <div class='w-full flex gap-4 py-2'>
            <div class='w-14 h-14 rounded-full mt-1 shrink-0'>
                <img src='/VHS/public/uploads/avatars/{$userImg}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
            </div>
    
            <div class='flex flex-col flex-1'>
                <div class='flex items-baseline gap-3'>
                    <p class='text-lg text-white font-semibold'>$name</p> 
                    <p class='text-sm text-white'>$created_at</p>
                </div>
    
                <div class='mt-1 text-xs font-semibold text-gray-400 max-w-xl'>
                    <p>$text</p>
                </div>
            </div>
            <a href="/VHS/pages/home/video.php?id=$videoId">
                <img src="$thumbnailURL" alt="Thumbnail de video" class="w-40 h-full rounded-xl hidden md:block"/>
            </a>
        </div>
        HTML;

}
