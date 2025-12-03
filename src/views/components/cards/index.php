<?php

namespace Src\Views\Components\Cards;

require_once __DIR__ . "/../../../application/utils/purify/index.php";
require_once __DIR__ . "/../modal/removeVideo.component.php";
require_once __DIR__ . "/../videoCard/index.php";
require_once __DIR__ . "/../fastCard/index.php";

use function Src\Application\Utils\Purify\purifyProperty;
use function Src\Application\Utils\Purify\purifyNumbers;
use function Src\Application\Utils\Purify\purifyDuration;
use function Src\Application\Utils\Purify\purifyCreatedAt;
use function Src\Application\Utils\Purify\purifyDateTime;
use function Src\Views\Components\Modal\RemoveVideoComponent;
use function Src\Views\Components\VideoCard\VideoCardComponent;
use function Src\Views\Components\FastCard\FastCardComponent;

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
                return VideoCardComponent($card);
            case 'mychannel':
                return self::MyChannel($card);
            case 'channels':
                return self::Channels($card);
            case 'fasts':
                return FastCardComponent($card);
            default:
                return "<h1 class='text-white/50'>Esse card não existe...</h1>";;
        }
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
            <div class="card group relative bg-[#121214] border border-white/5 rounded-2xl overflow-hidden hover:border-purple-500/30 hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-purple-500/10">
                <!-- Thumbnail Section -->
                <a href='/VHS/studio/content/video/analytic?id=$id' class='block relative aspect-video overflow-hidden'>
                    <img src='$thumbnail_url' class='w-full h-full object-cover transition-transform duration-500 group-hover:scale-105'>
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                    <div class='absolute bottom-2 right-2 bg-black/80 backdrop-blur-sm text-white text-xs font-medium px-2 py-1 rounded'>
                        $duration
                    </div>
                </a>

                <!-- Content Section -->
                <div class='p-4'>
                    <div class="flex justify-between items-start gap-3 mb-3">
                        <a href='/VHS/studio/content/video/analytic?id=$id' class="flex-1">
                            <h3 class='text-base font-semibold text-white leading-tight line-clamp-2 group-hover:text-purple-400 transition-colors' title="$title">
                                $title
                            </h3>
                        </a>
                        
                        <!-- Options Menu Trigger -->
                        <div class='relative video_options'>
                            <button class="p-1.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class='absolute right-0 top-full mt-2 w-48 bg-[#1E1E20] border border-white/10 rounded-xl shadow-2xl overflow-hidden z-20 hidden options origin-top-right transform transition-all duration-200'>
                                <div class="p-1.5 space-y-0.5">
                                    <a href="/VHS/studio/content/video/edit?id=$id" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-colors group/item">
                                        <svg class="w-4 h-4 text-gray-500 group-hover/item:text-purple-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Editar
                                    </a>
                                    <div class='remove_video w-full'>
                                        <button class="flex items-center w-full gap-3 px-3 py-2.5 text-sm text-gray-300 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors group/item">
                                            <svg class="w-4 h-4 text-gray-500 group-hover/item:text-red-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Excluir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                        <span>$created_at</span>
                    </div>
                    
                    <!-- Stats Grid -->
                    <div class='grid grid-cols-3 gap-2 border-t border-white/5 pt-4'>
                        <div class='flex flex-col items-center gap-1 text-center' title="Visualizações">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span class='text-xs font-medium text-gray-300'>$views</span>
                        </div>

                        <div class='flex flex-col items-center gap-1 text-center' title="Comentários">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span class='text-xs font-medium text-gray-300'>$comments</span>
                        </div>

                        <div class='flex flex-col items-center gap-1 text-center' title="Avaliações">
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class='text-xs font-medium text-gray-300'>$avaliations</span>
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
}
