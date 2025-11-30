<?php

namespace src\views\components\FastComponent;

require_once __DIR__ . '/../shared/shared.php';

use function src\views\components\Shared\sharedComponent;

function FastComponent(array $data): string
{
    $id = $data["id"];
    $video = htmlspecialchars($data['url']);
    $user = htmlspecialchars($data['user']);
    $avatarURL = "/VHS/public/uploads/avatars/" . ($data['avatar_url'] ?? "default.png");
    $title = htmlspecialchars($data['title']);
    $likes = htmlspecialchars($data['likes'] ?? '0');
    $userLiked = $data['user_liked'] ?? false;

    $fill = $userLiked ? '#ef4444' : 'white';
    $likeClass = $userLiked ? 'text-red-500' : 'text-white';

    $server = $_SERVER['HTTP_HOST'];
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $shareUrl = "$protocol://$server/VHS/home/fasts?id={$id}";
    $sharedHtml = sharedComponent(
        $shareUrl,
        $title,
        $id
    );

    return <<<HTML
        <div data-id="{$id}" class='snap-center shrink-0 w-full h-full flex items-center justify-center lg:p-4 relative'>
            
            <div class="relative w-full h-full mx-auto justify-center lg:flex lg:flex-row lg:items-end lg:gap-6">
                
                <div class="relative flex-1 h-full w-full lg:max-w-[40rem] bg-black lg:rounded-3xl overflow-hidden cursor-pointer shadow-2xl group lg:border border-white/10" onclick="playVideo(event)">
                    <video src='{$video}' class='w-full h-full object-cover' loop playsinline></video>
                    
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none play">
                        <div class="bg-black/50 p-6 rounded-full backdrop-blur-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 w-full p-4 lg:p-8 bg-gradient-to-t from-black/90 via-black/50 to-transparent pointer-events-none">
                        <div class="pointer-events-auto flex flex-col gap-3 pr-16 lg:pr-0">
                            <a href="/VHS/home/channel?username={$user}" class='flex items-center gap-3 group/user hover:opacity-90 transition-opacity w-fit' onclick="event.stopPropagation()">
                                <img class='w-10 h-10 lg:w-12 lg:h-12 rounded-full object-cover border-2 border-white' src='{$avatarURL}' alt='{$user}'>
                                <div class="flex flex-col">
                                    <h3 class='text-white font-bold text-base lg:text-lg drop-shadow-md'>@{$user}</h3>
                                </div>
                            </a>
                            <h2 class="text-white text-base lg:text-lg font-medium leading-snug line-clamp-2 drop-shadow-md">
                                {$title}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="absolute right-2 bottom-20 z-30 flex flex-col gap-6 lg:static lg:gap-8 lg:pb-12 lg:shrink-0">
                    
                    <div class='flex flex-col items-center gap-1 lg:gap-2 cursor-pointer group/like' onclick="likeFast(event, '$id')">
                        <div class="p-3 lg:p-4 bg-black/40 lg:bg-[#1F1F22] hover:bg-[#2a2a2e] backdrop-blur-md lg:backdrop-blur-none rounded-full transition-all transform active:scale-95 border border-white/10 shadow-lg">
                            <svg width='28' height='28' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' id='heart' class="transition-colors duration-300 lg:w-8 lg:h-8">
                                <path d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z' fill="$fill" stroke="currentColor" stroke-width="0"/>
                            </svg>
                        </div>
                        <span class='text-white text-xs lg:text-sm font-bold likes drop-shadow-md'>{$likes}</span>
                    </div>

                    <div class='flex flex-col items-center gap-1 lg:gap-2 cursor-pointer group/share' onclick='event.stopPropagation(); openShared(event, "{$id}")'>
                        <div class="p-3 lg:p-4 bg-black/40 lg:bg-[#1F1F22] hover:bg-[#2a2a2e] backdrop-blur-md lg:backdrop-blur-none rounded-full transition-all transform active:scale-95 border border-white/10 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 lg:w-8 lg:h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
                            </svg>
                        </div>
                        <span class='text-white text-xs lg:text-sm font-bold drop-shadow-md'>Share</span>
                    </div>

                </div>
            </div>

            {$sharedHtml}
        </div>
    HTML;
}
