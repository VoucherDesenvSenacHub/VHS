<?php
namespace Src\Views\Components\Cards;

require_once __DIR__ . "/formatCard.php";

use function Src\Application\Utils\Purify\purifyProperty;
use function Src\Views\Components\Utils\formatViews;

/**
 *  ButtonComponent - Componente para criar botões estilizados.
 * @param string $id - Id do video
 * @param string $title - Texto do botão.
 * @param string $thumbnail_url - URL da thumbnail do video.
 * @param int $views - Quantidade de visualizações do video.
 * @return string - HTML do card do video (studio).
**/
function StudioVideoComponent(string $id, string $title, string $thumbnail_url, int $views) {
    $id = purifyProperty($id);
    $title = purifyProperty($title);
    $thumbnail_url = purifyProperty($thumbnail_url);
    $views = formatViews($views);

    return <<<HTML
        <div class="flex gap-2">
            <img src="$thumbnail_url" alt="" class="w-32 rounded-lg">
            <div>
                <h2 class="font-medium text-white">$title</h2>
                <p class="text-secondary">$views de visualizações</p>
                <div class="flex gap-4 mt-1">
                    <a href="">
                        <img src="/VHS/public/icons/pencill.svg" alt="" class="size-5">
                    </a>
                     <a href="">
                        <img src="/VHS/public/icons/graph.svg" alt="" class="size-5">
                    </a>
                     <a href="">
                        <img src="/VHS/public/icons/comentariocomental.svg" alt="" class="size-6">
                    </a>
                </div>
            </div>
        </div>
    HTML;
}