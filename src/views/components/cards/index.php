<?php

namespace Src\Views\Components\Cards;

require_once __DIR__ . "/../../../application/utils/purify/index.php";

use function Src\Application\Utils\Purify\purifyProperty;
use function Src\Application\Utils\Purify\purifyNumbers;
use function Src\Application\Utils\Purify\purifyDuration;
use function Src\Application\Utils\Purify\purifyCreatedAt;
use function Src\Application\Utils\Purify\purifyDateTime;

function viewCards(array $cards, string $type): string {
    $html = '';

    foreach ($cards as $card) {
        $html .= Cards::Renderer($card, $type);
    }

    if ($html === '') {
        $html = "<h1 class='text-white'>Nenhum vídeo encontrado...</h1>";
    }

    return $html;
}

class Cards {
    public static function Renderer(array $card, string $type): string {
        switch ($type) {
            case 'videos'   : return self::Video($card);
            case 'events'   : return self::Event($card);
            case 'mychannel': return self::MyChannel($card);
            case 'channels' : return self::Channels($card);
            case 'fasts'    : return self::Fast($card);
            default         : return 'Esse card não existe...';
        }
    }

    private static function Video(array $card): string {
        $url        = purifyProperty($card['url']);
        $thumbnail  = purifyProperty($card['thumbnail']);
        $username   = purifyProperty($card['username']);
        $avatar_url = purifyProperty($card['avatar_url']);
        $title      = purifyProperty($card['title']);
        $views      = purifyNumbers($card['views']);
        $duration   = purifyDuration($card['duration']);
        $created_at = purifyCreatedAt($card['created_at']);

        return <<<HTML
            <a href='$url' class='card flex flex-col cursor-pointer relative max-w-[340px] h-[340px] bg-gray600 rounded-3xl overflow-hidden shadow-lg transition-all duration-300'>
                <div class='relative w-full h-[50%]'>
                    <img src='$thumbnail' class='w-full h-full object-cover'>

                    <div class='absolute top-3 right-3 bg-black/75 px-2 py-1 rounded-md'>
                        <p class='text-white text-caption 2xl:text-paragraph'>$duration</p>
                    </div>
                </div>

                <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                    <p class='truncate text-gray-400 text-caption 2xl:text-paragraph pr-16'>
                        $username
                    </p>

                    <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3'
                        style='
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;
                        '
                    >
                        $title
                    </h3>

                    <p class='text-gray-400 text-caption 2xl:text-paragraph'>
                        $views views • $created_at
                    </p>
                </div>

                <div class='absolute w-full h-full flex items-center justify-end p-5'>
                    <div class='relative w-20 h-20 2xl:w-20 2xl:h-20 flex items-center justify-center'>
                        <div class='absolute flex w-full h-full items-center justify-center rounded-full overflow-hidden bg-white/5'>
                            <img src='$avatar_url' class='w-full h-full object-cover'>
                        </div>
                    </div>
                </div>
            </a>
        HTML;
    }

    private static function Event(array $card): string {
        $url         = purifyProperty($card['url']);
        $thumbnail   = purifyProperty($card['thumbnail']);
        $description = purifyProperty($card['description']);
        $username    = purifyProperty($card['username']);
        $title       = purifyProperty($card['title']);
        $views       = purifyNumbers($card['views']);
        $event_date  = purifyDateTime($card['event_date']);

        return <<<HTML
            <a href='$url' class='card flex flex-col cursor-pointer max-w-[340px] h-[340px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                <div class='relative w-full h-[50%]'>
                    <img src='$thumbnail' class='w-full h-full object-cover'>

                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-caption 2xl:text-paragraph px-4 py-1 rounded-md'>
                        🔥  
                    </div>
                </div>

                <div class='p-3 text-white flex flex-col justify-between h-[50%]'>
                    <p class='text-gray-400 text-caption 2xl:text-paragraph'>$description | $username</p>

                    <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3'
                        style='
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;
                        '
                    >
                        $title
                    </h3>

                    <p class='text-gray-400 text-caption 2xl:text-paragraph'>$views views • $event_date</p>
                </div>
            </a>
        HTML;
    }

    private static function MyChannel(array $card): string {
        $url        = purifyProperty($card['url']);
        $thumbnail  = purifyProperty($card['thumbnail']);
        $title      = purifyProperty($card['title']);
        $comments   = purifyNumbers($card['comments']);
        $likes      = purifyNumbers($card['likes']);
        $views      = purifyNumbers($card['views']);
        $created_at = purifyCreatedAt($card['created_at']);
        $duration   = purifyDuration($card['duration']);

        return <<<HTML
            <a href='$url' class='card flex flex-col cursor-pointer max-w-[340px] h-[340px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                <div class='relative w-full h-[50%]'>
                    <img src='$thumbnail' class='w-full h-full object-cover'>
                    
                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-caption px-2 py-1 rounded-md'>
                        <p class='text-white text-caption 2xl:text-paragraph'>$duration</p>
                    </div>
                </div>

                <div class='p-4 text-white flex flex-col justify-between flex gap-2 h-[50%]'>
                    <p class='text-gray-400 text-caption 2xl:text-paragraph'>$created_at</p>

                    <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3'
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

                            <p class='text-gray-400 text-caption 2xl:text-paragraph'>$comments</p>
                        </div>

                        <div class='flex gap-2 items-center'>
                            <div>
                                <img src='/VHS/public/icons/star-card.svg' class='w-full h-full'>
                            </div>

                            <p class='text-gray-400 text-caption 2xl:text-paragraph'>$likes</p>
                        </div>

                        <div class='flex gap-2 items-center'>
                            <div>
                                <img src='/VHS/public/icons/views-card.svg' class='w-full h-full'>
                            </div>

                            <p class='text-gray-400 text-caption 2xl:text-paragraph'>$views</p>
                        </div>
                    </div>
                </div>
            </a>
        HTML;
    }

    private static function Channels(array $card): string {
        $url       = purifyProperty($card['url']);
        $thumbnail = purifyProperty($card['thumbnail']);
        $username  = purifyProperty($card['username']);
        $title     = purifyProperty($card['title']);
        $duration  = purifyDuration($card['duration']);
        $views     = purifyNumbers($card['views']);
        $created_at = purifyCreatedAt($card['created_at']);

        return <<<HTML
            <a href='$url' class='card flex flex-col cursor-pointer max-w-[340px] h-[340px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                <div class='relative w-full h-[50%]'>
                    <img src='$thumbnail' class='w-full h-full object-cover'>

                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 px-2 py-1 rounded-md'>
                        <p class='text-white text-caption 2xl:text-paragraph'>$duration</p>
                    </div>
                </div>

                <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                    <p class='text-gray-400 text-caption 2xl:text-paragraph'>$username</p>

                    <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3'
                        style='
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;
                        '
                    >
                        $title
                    </h3>

                    <p class='text-gray-400 text-caption 2xl:text-paragraph'>$views views • $created_at</p>
                </div>
            </a>
        HTML;
    }

    private static function Fast(array $card): string {
        $url       = purifyProperty($card['url']);
        $thumbnail = purifyProperty($card['thumbnail']);
        $title     = purifyProperty($card['title']);
        $likes     = purifyNumbers($card['likes']);
        $views     = purifyNumbers($card['views']);

        return <<<HTML
            <a href='$url' class='current_fast cursor-pointer flex-shrink-0 w-[340px] h-[35rem] relative flex items-center justify-center rounded-3xl overflow-hidden'>
                <img src='$thumbnail' class='w-full object-cover h-full absolute'>

                <div class='block w-full bottom-12 absolute px-1'>
                    <h2 class='text-white ml-3.5'>$title</h2>

                    <div class='mt-2 w-full flex gap-4 px-4 absolute'>
                        <div class='flex items-center gap-2.5'>
                            <img src='/VHS/public/icons/fastIcon/Vector.svg'>
                            <p class='text-sm text-white'>$likes</p>
                        </div>

                        <div class='flex items-center gap-2.5'>
                            <img src='/VHS/public/icons/fastIcon/eyeIcon.svg'>
                            <p class='text-sm text-white'>$views</p>
                        </div>
                    </div>
                </div>
            </a>

            <script src='/VHS/src/views/components/CardFastComponent/cardFast.js' defer></script>
        HTML;
    }

}