<?php

namespace Views\Components\FeaturedCard;

/**
 * Componente para exibir um card de vídeo em destaque.
 *
 * @param array $video Array contendo os dados do vídeo, incluindo:
 *               - 'url': string.
 *               - 'duration': string.
 *               - 'title': string.
 *               - 'username': string.
 *               - 'thumbnail_url': string.
 *               - 'avatar_url': string.
 *               - 'views': string.
 *               - 'created_at: int.
 * @param isCategoryPage booleano opcional que indica se o card está sendo exibido em uma página de categoria.
 * 
 * @return string Retorna o HTML do card de vídeo.
 */
function FeaturedCardComponent(array $video, bool $isCategoryPage = false): string{
    $height = $isCategoryPage ? 'h-[450px]' : 'h-[330px]';

    return <<<HTML
        <div class="relative bg-gradient-to-r from-red-600/20 to-purple-600/20 rounded-3xl overflow-hidden shadow-lg cursor-pointer $height">
            <img src="{$video['thumbnail_url']}" alt="{$video['title']}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative z-10 p-6 h-full flex flex-col justify-end">
                <div class="flex items-center gap-3 mb-3">
                    <img src="{$video['avatar_url']}" alt="{$video['username']}" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <p class="text-white text-sm font-medium">{$video['username']}</p>
                        <p class="text-gray-300 text-xs">{$video['views']} • {$video['created_at']}</p>
                    </div>
                    <div class="ml-auto bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded-md">
                        {$video['duration']}
                    </div>
                </div>
                <h2 class="text-white text-lg 2xl:text-xl font-bold leading-tight line-clamp-2">{$video['title']}</h2>
            </div>
        </div>
    HTML;
}