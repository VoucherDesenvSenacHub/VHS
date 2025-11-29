<?php
namespace src\views\components\FastComponent;

require_once __DIR__ . '/../shared/shared.php';
use function src\views\components\Shared\sharedComponent;

// TODO: REFATORAR ESSE COMPONENTE
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

    $server = $_SERVER['HTTP_HOST'];
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $shareUrl = "$protocol://$server/VHS/home/fasts?id={$id}";
    $sharedHtml = sharedComponent(  
        $shareUrl,
        $title,
        $id
    );

    return <<<HTML
        <div data-id="{$id}" onclick="playVideo(event)" class='snap-center touch-pan-y overflow-auto w-full min-h-full relative flex items-center justify-center current-fast'>
            <video src='{$video}' class='object-cover h-full absolute -z-10 rounded-xl max-[480px]:rounded-none' loop></video>
            <img src='/VHS/public/icons/fastIcon/setinha.svg' alt='' class=' absolute left-[0.5rem] top-[1rem]'/>
            <img src='/VHS/public/icons/fastIcon/Play.svg' alt='' class='size-16 play'/>
            <div class='flex items-center flex-col absolute right-4 bottom-32 gap-2 z-10' onclick="likeFast(event, '$id')">
                <svg width='40' height='35' viewBox='0 0 40 35' fill='none' xmlns='http://www.w3.org/2000/svg' id='heart' class='z-50'>
                    <path d='M0 11.8981C0 21.7849 8.03885 27.0534 13.9235 31.7692C16 33.4332 18 35 20 35C22 35 24 33.4332 26.0765 31.7692C31.9611 27.0534 40 21.7849 40 11.8981C40 2.01125 28.9997 -5.0003 20 4.50478C11.0003 -5.0003 0 2.01125 0 11.8981Z' fill="$fill" class="transition-colors"/>
                </svg>
                <p class='text-white text-sm likes'>{$likes}</p>
            </div>
            <img src='/VHS/public/icons/fastIcon/Share.svg' alt='' class='absolute right-4 bottom-16'>
            <img name='send'src='/VHS/public/icons/fastIcon/Share.svg' alt='' class=' cursor-pointer absolute right-4 bottom-16' onclick='openShared(event, "{$id}")'>
            {$sharedHtml}
            <div class='flex flex-col absolute left-8 bottom-12 text-white gap-4'>
                <div class='flex gap-2'>
                    <img class='size-8 rounded-full object-cover' src='{$avatarURL}' alt=''>
                    <h3 class='text-xl font-semibold'>@{$user}</h3>
                </div>
                <h2 class="font-medium">{$title}</h2>
            </div>
        </div>
    HTML;
}
