<?php
namespace src\views\components\FastComponent;

require_once __DIR__ . '/../shared/shared.php'; 
use function src\views\components\Shared\sharedComponent;

// TODO: REFATORAR ESSE COMPONENTE
function FastComponent(array $data): string {
    $video = htmlspecialchars($data['video_url']);
    $user = htmlspecialchars($data['user']);
    $userimg = htmlspecialchars($data['userimg']);
    $titulo = htmlspecialchars($data['titulo']);
    $likes = htmlspecialchars($data['likes'] ?? '0');


    $sharedHtml = sharedComponent(
        'https://youtu.be/UG5O35YtgTA?feature=shared',
        'video teste sla'
    );

    return <<<HTML
        <div class='w-full min-h-full relative flex items-center justify-center current-fast'>
            <video src='{$video}' class='object-cover h-full absolute -z-10 rounded-xl' autoplay loop></video>
            <img src='/VHS/public/icons/fastIcon/setinha.svg' alt='' class=' absolute left-[0.5rem] top-[1rem]'/>
            <img src='/VHS/public/icons/fastIcon/Play.svg' alt='' class='size-16 play'/>
            <div class='flex items-center flex-col absolute right-4 bottom-32 gap-2'>
                <svg width='40' height='35' viewBox='0 0 40 35' fill='none' xmlns='http://www.w3.org/2000/svg' id='heart' class='z-50'>
                    <path d='M0 11.8981C0 21.7849 8.03885 27.0534 13.9235 31.7692C16 33.4332 18 35 20 35C22 35 24 33.4332 26.0765 31.7692C31.9611 27.0534 40 21.7849 40 11.8981C40 2.01125 28.9997 -5.0003 20 4.50478C11.0003 -5.0003 0 2.01125 0 11.8981Z' fill='white' class="transition-colors"/>
                </svg>
                <p class='text-white text-sm likes'>{$likes}</p>
            </div>
            <img src='/VHS/public/icons/fastIcon/Share.svg' alt='' class='absolute right-4 bottom-16'>
            <img name='send'src='/VHS/public/icons/fastIcon/Share.svg' alt='' class=' cursor-pointer absolute right-4 bottom-16' onclick='openShared()'>
            {$sharedHtml}
            <div class='flex flex-col absolute left-2 bottom-12 text-white gap-4'>
                <div class='flex gap-2'>
                    <img class='size-8 rounded-sm object-cover' src='{$userimg}' alt=''>
                    <h3 class='text-xl font-semibold'>@{$user}</h3>
                </div>
                <h2 class="font-medium">{$titulo}</h2>
            </div>
        </div>
        <script src='/VHS/src/views/components/fastComponent/fastComponent.js'></script>
    HTML;
}
