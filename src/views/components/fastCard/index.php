<?php

namespace Src\Views\Components\FastCard;

require_once __DIR__ . "/../../../application/utils/purify/index.php";
require_once __DIR__ . "/../modal/removeVideo.component.php";

use function Src\Application\Utils\Purify\purifyProperty;
use function Src\Application\Utils\Purify\purifyNumbers;
use function Src\Views\Components\Modal\RemoveVideoComponent;

function FastCardComponent(array $card, bool $isStudio = false)
{
    $id        = purifyProperty($card['id']);
    $url       = "/VHS/home/fasts?id=" . $id;
    $thumb_url = "/VHS/public/thumbnails/" . $card['thumbnail_url'];
    $title     = purifyProperty($card['title']);
    $likes     = purifyNumbers($card['likes']);
    $views     = purifyNumbers($card['views']);

    $optionsMenu = '';
    if ($isStudio) {
        $optionsMenu = <<<HTML
            <div class='absolute top-2 right-2 z-20 video_options'>
                <button class="p-1.5 bg-black/40 backdrop-blur-sm text-white hover:bg-black/60 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>

                <div class='absolute right-0 top-full mt-2 w-48 bg-[#1E1E20] border border-white/10 rounded-xl shadow-2xl overflow-hidden hidden options origin-top-right transform transition-all duration-200'>
                    <div class="p-1.5 space-y-0.5">
                        <a href="/VHS/studio/content/fast/edit?id=$id" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-colors group/item">
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
        HTML;
    }

    // Modal for delete confirmation (only needed if studio)
    $modalHtml = '';
    if ($isStudio) {
        // We need to require the component if not already required, but usually it's handled by the parent or autoloader.
        // Assuming RemoveVideoComponent is available or we can inline a simple version, 
        // but better to use the component we just redesigned.
        // Note: The parent file (fast.php) needs to ensure RemoveVideoComponent is loaded.
        // However, FastCardComponent is a function, so we can call RemoveVideoComponent here if it's in scope.
        // Let's assume it's available or we'll add the require.

        $modalVideoRemove = RemoveVideoComponent(
            'Remover Short',
            'Tem certeza que deseja excluir este short?',
            $id,
            '/VHS/api/v1/fast/delete'
        );

        $modalHtml = <<<HTML
            <div class='hidden modal_remove_video'>
                $modalVideoRemove
            </div>
        HTML;
    }

    return <<<HTML
    <div class="card relative group w-full aspect-[9/16] rounded-xl overflow-hidden bg-gray-900 block">
        <a href='$url' class='block w-full h-full'>
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
        $optionsMenu
        $modalHtml
    </div>
    HTML;
}
