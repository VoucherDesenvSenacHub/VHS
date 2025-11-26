<?php

namespace Src\Views\Components\Utils;

function CommentStudioComponent(string $name, string $text,  string | null $created_at = null, string | null $userImg = null, string | null $thumbnailURL = null, string | null $videoId = null, $isVideoComments = false, string | null $comment_id = null, int | null $creator_like = null, string | null $user_blocked_id = null)
{
    $userImg = <<<HTML
                <div class='flex-shrink-0 w-12 h-12 rounded-full bg-white/10 overflow-hidden'>
                    <img class='select-none pointer-events-none w-full h-full object-cover' src='/VHS/public/uploads/avatars/{$userImg}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
                </div>
    HTML;

    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

    $thumbnailURL = htmlspecialchars($thumbnailURL ?? '', ENT_QUOTES, 'UTF-8');

    $videoId = htmlspecialchars($videoId ?? '', ENT_QUOTES, 'UTF-8');

    $created_at = $created_at ? "<p class='text-xs text-gray-300 font-semibold ml-1'>" . htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') . "</p>" : "";

    $thubnailHTML = "";

    $comment_id = htmlspecialchars($comment_id, ENT_QUOTES, 'UTF-8');

    $creator_like = htmlspecialchars($creator_like, ENT_QUOTES, 'UTF-8');

    $user_blocked_id = htmlspecialchars($user_blocked_id, ENT_QUOTES, 'UTF-8');

    $current_user_id = $_SESSION['user']['id'];

    if (!$isVideoComments) {
        $thubnailHTML .= <<<HTML
            <a href="/VHS/pages/home/video.php?id=$videoId">
                <img src="$thumbnailURL" alt="Thumbnail de video" class="w-40 h-full rounded-xl hidden md:block"/>
            </a>
        HTML;
    }

    $likeSrc = $creator_like ? '/VHS/public/icons/comments/favorite-comment-filled.svg' : '/VHS/public/icons/comments/favorite-comment.svg';

    return
        <<<HTML
        <div class='w-full flex gap-4 py-2'>
            <div class='w-14 h-14 rounded-full mt-1 shrink-0'>
                $userImg
            </div>
    
            <div class='flex flex-col flex-1'>
                <div class='flex items-baseline'>
                    <p class='text-lg text-white font-semibold'>$name</p> 
                    $created_at
                </div>
    
                <div class='mt-1 text-xs font-semibold text-gray-400 max-w-xl'>
                    <p>$text</p>
                </div>
                
                <div class='mt-2'>
                    <ul class='w-full flex gap-3'>  
                        <li>
                            <img src='/VHS/public/icons/comments/trash.svg' onclick='deleteComment(event,"{$comment_id}", "{$name}")'>
                        </li>
                        <li>
                            <img like="$creator_like" src=' $likeSrc' onclick='likeComment(event, "{$comment_id}", "{$creator_like}")'>
                        </li>
                        <li>
                            <img src='/VHS/public/icons/comments/user-block.svg' onclick='blockUser(event, "{$current_user_id}", "{$name}", "{$user_blocked_id}")'>
                        </li>
                    </ul>    
                </div>
            </div>

            
            $thubnailHTML
        </div>
    HTML;
}