<?php

namespace Src\Views\Components\Cards;

require_once __DIR__ . "/../../../application/utils/purify/index.php";
require __DIR__ . "/../modal/removeVideo.component.php";

use function Src\Application\Utils\Purify\purifyProperty;
use function Src\Application\Utils\Purify\purifyNumbers;
use function Src\Application\Utils\Purify\purifyDuration;
use function Src\Application\Utils\Purify\purifyCreatedAt;
use function Src\Application\Utils\Purify\purifyDateTime;
use function Src\Views\Components\Modal\RemoveVideoComponent;

function viewCards(array $cards, string $type)
{
    $html = '';

    foreach ($cards as $card) {
        $html .= Cards::Renderer($card, $type);
    }

    if ($html === '') {
        $html = "<h1 class='text-white'>Nenhum vídeo encontrado...</h1>";
    }

    return $html;
}

class Cards
{

    public static function Renderer(array $card, string $type)
    {
        switch ($type) {
            case 'videos':
                return self::Video($card);
            case 'events':
                return self::Event($card);
            case 'mychannel':
                return self::MyChannel($card);
            case 'channels':
                return self::Channels($card);
            case 'fasts':
                return self::Fast($card);
            default:
                return "<h1 class='text-white/50'>Esse card não existe...</h1>";;
        }
    }

    private static function Video(array $card)
    {
        $id         = purifyProperty($card["id"]);
        $url        = purifyProperty($card['url']);
        $views      = purifyNumbers($card['views']);
        $thumb_url  = purifyProperty($card['thumbnail_url']);
        $name       = purifyProperty($card['username']);
        $avatar_url = purifyProperty($card['avatar_url']);
        $title      = purifyProperty($card['title']);
        $duration   = purifyDuration($card['duration']);
        $created_at  = purifyCreatedAt($card['created_at']);

        return <<<HTML
            <a href='/VHS/home/video?id=$id' class='card flex flex-col relative max-w-[310px] h-[310px] 2xl:max-w-[340px] 2xl:h-[340px] bg-gray600 rounded-3xl overflow-hidden shadow-lg transition-all duration-200 border-2 border-gray600 active:scale-[98%]'>
                <div class='relative w-full h-[50%] bg-white/5'>
                    <img src='$thumb_url' onerror="this.src='/VHS/public/uploads/thumbs/default.png'" class='w-full h-full object-cover'>

                    <div class='absolute top-3 right-3 bg-black/75 px-2 py-1 rounded-md'>
                        <p class='text-white text-caption 2xl:text-paragraph'>$duration</p>
                    </div>
                </div>

                <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                    <p class='truncate text-white/50 text-paragraph pr-24'>
                        $name
                    </p>

                    <h3 class='text-subtitle leading-tight break-words overflow-hidden line-clamp-3'
                        style='
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;
                        '
                    >
                        $title
                    </h3>

                    <p class='text-[#808191] text-caption 2xl:text-paragraph'>
                        $views views • $created_at
                    </p>
                </div>

                <div class='absolute w-full h-full flex items-center justify-end p-5'>
                    <div class='relative w-20 h-20 2xl:w-20 2xl:h-20 flex items-center justify-center'>
                        <div class='absolute flex w-full h-full items-center justify-center rounded-full overflow-hidden bg-gray600 border-2 border-gray600'>
                            <img src='/VHS/public/uploads/avatars/$avatar_url' class='w-full h-full object-cover' onerror="this.src='/VHS/public/uploads/avatars/default.png'">
                        </div>
                    </div>
                </div>
            </a>
        HTML;
    }

    private static function Event(array $card)
    {
        $url        = purifyProperty($card['url']);
        $name       = purifyProperty($card['name']);
        $thumb_url  = purifyProperty($card['thumbnail_url']);
        $category   = purifyProperty($card['category']);
        $title      = purifyProperty($card['title']);
        $event_date = purifyDateTime($card['event_date']);

        return <<<HTML
            <a href='$url' class='card flex flex-col relative max-w-[310px] h-[310px] 2xl:max-w-[340px] 2xl:h-[340px] bg-gray600 rounded-3xl overflow-hidden shadow-lg transition-all duration-200 border-2 border-gray600 active:scale-[98%]'>
                <div class='relative w-full h-[50%] bg-white/5'>
                    <img src='$thumb_url' onerror="this.src='/VHS/public/uploads/thumbs/default.png'" class='w-full h-full object-cover pointer-events-none'>

                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-caption 2xl:text-paragraph px-4 py-1 rounded-md'>
                        🔥  
                    </div>
                </div>

                <div class='p-3 text-white flex flex-col justify-between h-[50%]'>
                    <p class='truncate text-white/50 text-paragraph'>$name</p>

                    <h3 class='text-subtitle leading-tight break-words overflow-hidden line-clamp-3'
                        style='
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;
                        '
                    >
                        $title
                    </h3>

                    <p class='text-white/50 text-caption 2xl:text-paragraph'>#$category • $event_date</p>
                </div>
            </a>
        HTML;
    }

    private static function MyChannel(array $card): string
    {
        $userTimezone = $_SESSION['user']['timezone'] ?? 'UTC';

        $id = purifyProperty($card['id']);
        $thumbnail_url  = purifyProperty($card['thumbnail_url']);
        $title      = purifyProperty($card['title']);
        $comments = purifyNumbers($card['comments'] ?? 0);
        $avaliations = $card['avaliations'] ?? 0;
        $views = purifyNumbers($card['views'] ?? 0);
        $created_at = purifyCreatedAt($card['created_at'], $userTimezone);
        $duration   = purifyDuration($card['duration']);

        $modalVideoRemove = RemoveVideoComponent(
            'Remover Vídeo',
            'Tem certeza que deseja excluir o vídeo?',
            $id
        );

        return <<<HTML
            <div class="card flex flex-col max-w-[290px] h-[300px] lg:max-w-[340px] lg:h-[360px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                <a href='/VHS/studio/content/video/analytic?id=$id' class='cursor-pointer relative w-full h-[50%]'>
                    <img src='$thumbnail_url' class='w-full h-full object-cover'>
                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-caption px-2 py-1 rounded-md'>
                        <p class='text-white lg:text-paragraph'>$duration</p>
                    </div>
                </a>

                <div class='relative p-4 text-white flex flex-col justify-between flex gap-2 h-[50%]'>
                    <p class='text-[#808191] lg:text-paragraph'>$created_at</p>

                    <h3 class='lg:text-subtitle text-lg leading-tight break-words overflow-hidden line-clamp-3'
                        style='
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;
                        '
                    >
                        $title
                    </h3>
                    
                    <div class='flex justify-between'>
                        <div class='flex gap-2 items-center'>
                            <div>
                                <img src='/VHS/public/icons/comments-card.svg' class='w-full h-full'>
                            </div>
                            <p class='truncate text-white/50 text-paragraph'>$comments</p>
                        </div>

                        <div class='flex gap-2 items-center'>
                            <div>
                                <img src='/VHS/public/icons/star-card.svg' class='w-full h-full'>
                            </div>
                            <p class='truncate text-white/50 text-paragraph'>$avaliations</p>
                        </div>

                        <div class='flex gap-2 items-center'>
                            <div>
                                <img src='/VHS/public/icons/views-card.svg' class='w-full h-full'>
                            </div>
                            <p class='truncate text-white/50 text-paragraph'>$views</p>
                        </div>

                        <div class='cursor-pointer video_options'>
                            <img src="/VHS/public/icons/fastIcon/3botao.svg" alt="" class='w-ful h-full'>
                        </div>
                    </div>
                    <div class='w-[55%] absolute flex flex-col z-10 bg-[#2A2A2C] p-2 text-white bottom-9 right-4 gap-3 rounded-lg hidden options'>
                        <a href="/VHS/studio/content/video/edit?id=$id">
                            <button
                                class="group flex items-center justify-center gap-2 w-full
                                border border-white/40 rounded-xl py-2 px-4
                                transition-all duration-200 hover:bg-purple-700 bg-white/5"
                            >
                                <img src="/VHS/public/icons/pencill.svg"
                                    class="w-4 h-4 transition-all duration-200 group-hover:brightness-0 group-hover:invert" />
                                <span class="transition-all duration-200 text-white">Editar vídeo</span>
                            </button>
                        </a>
                        <div class='cursor-pointer remove_video'>
                            <button
                                class="group flex items-center justify-center gap-2 w-full
                                border border-white/40 text-white/80 rounded-xl py-2 px-4
                                transition-all duration-200 hover:bg-red-600 bg-white/5"
                            >
                                <img src="/VHS/public/icons/trash.svg"
                                    class="w-4 h-4 transition-all duration-200 group-hover:brightness-0 group-hover:invert" />
                                <span class="transition-all duration-200 text-white">Excluir vídeo</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class='hidden modal_remove_video'>
                    $modalVideoRemove
                </div>
            </div>
        HTML;
    }

    private static function Channels(array $card)
    {
        $url       = purifyProperty($card['url']);
        $thumb_url = purifyProperty($card['thumbnail_url']);
        $name      = purifyProperty($card['name']);
        $title     = purifyProperty($card['title']);
        $duration  = purifyDuration($card['duration']);
        $views     = purifyNumbers($card['views']);
        $created_at = purifyCreatedAt($card['created_at']);

        return <<<HTML
            <a href='$url' class='card flex flex-col relative max-w-[310px] h-[310px] 2xl:max-w-[340px] 2xl:h-[340px] bg-gray600 rounded-3xl overflow-hidden shadow-lg transition-all duration-200 border-2 border-gray600 active:scale-[98%]'>
                <div class='relative w-full h-[50%] bg-white/5'>
                    <img src='$thumb_url' onerror="this.src='/VHS/public/uploads/thumbs/default.png'" class='w-full h-full object-cover'>

                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 px-2 py-1 rounded-md'>
                        <p class='text-white text-paragraph'>$duration</p>
                    </div>
                </div>

                <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                    <p class='truncate text-white/50 text-paragraph'>$name</p>

                    <h3 class='text-subtitle leading-tight break-words overflow-hidden line-clamp-3'
                        style='
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;
                        '
                    >
                        $title
                    </h3>

                    <p class='text-[#808191] text-paragraph'>$views views • $created_at</p>
                </div>
            </a>
        HTML;
    }

    private static function Fast(array $card)
    {
        $url       = purifyProperty($card['url']);
        $thumb_url = purifyProperty($card['thumbnail_url']);
        $title     = purifyProperty($card['title']);
        $likes     = purifyNumbers($card['likes']);
        $views     = purifyNumbers($card['views']);

        return <<<HTML
            <a href='$url' class='current_fast box-border flex-shrink-0 w-[340px] h-[35rem] relative flex flex-col justify-end bg-white/10 rounded-3xl overflow-hidden'>
                <img src='$thumb_url' class='w-full h-full object-cover absolute inset-0' onerror="this.src='/VHS/public/uploads/thumbs/default.png'">
                <div class='absolute inset-0 bg-gradient-to-t from-black/75 to-transparent'></div>
                
                <div class='relative z-10 w-full p-4 flex flex-col gap-4'>
                    <h2 class='text-subtitle text-white leading-tight break-words overflow-hidden line-clamp-2'>
                        $title
                    </h2>

                    <div class='flex gap-6'>
                        <div class='flex items-center gap-2'>
                            <img src='/VHS/public/icons/fastIcon/vector.svg' class='w-5 h-5'>
                            <p class='text-paragraph text-white/50'>$likes</p>
                        </div>

                        <div class='flex items-center gap-2'>
                            <img src='/VHS/public/icons/fastIcon/eyeicon.svg' class='w-5 h-5'>
                            <p class='text-paragraph text-white/50'>$views</p>
                        </div>
                    </div>
                </div>
            </a>

            <script src='/VHS/src/views/components/CardFastComponent/cardFast.js' defer></script>
        HTML;
    }
}
