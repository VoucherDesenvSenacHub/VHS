<?php

namespace Src\Views\Components\Utils;

function Comment(string $name, string $text, string $thumbnail_url, string $created_at = null, string $userImg = null): string
{
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $thumbnail_url = htmlspecialchars($thumbnail_url, ENT_QUOTES, 'UTF-8');
    $created_at = $created_at ? htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') : null;

    $createdAtTag = $created_at
        ? "<p class='text-xs text-gray-300 font-semibold ml-1'>{$created_at}</p>"
        : "";

    return <<<HTML
        <div class="w-full flex gap-4 py-2">
             <div class='flex-shrink-0 w-12 h-12 rounded-full bg-white/10 overflow-hidden'>
                    <img class='select-none pointer-events-none w-full h-full object-cover' src='/VHS/public/uploads/avatars/{$userImg}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
                </div>

            <div class="flex flex-col flex-1">
                <div class="flex items-baseline">
                    <p class="text-lg text-white font-semibold">{$name}</p>
                    {$createdAtTag}
                </div>

                <div class="mt-1 text-xs font-semibold text-gray-400 max-w-xl">
                    <p>{$text}</p>
                </div>

                <div class="mt-2">
                    <ul class="w-full flex gap-3">  
                        <li>
                            <img src="/VHS/public/icons/comments/dialog.svg" alt="Responder">
                        </li>
                        <li>
                            <img src="/VHS/public/icons/comments/trash.svg" alt="Excluir">
                        </li>
                        <li>
                            <img src="/VHS/public/icons/comments/user-block.svg" alt="Bloquear usuário">
                        </li>
                    </ul>    
                </div>
            </div>

            <div>
                <img class="h-20 rounded-lg" src="{$thumbnail_url}" alt="Thumbnail do comentário">
            </div>
        </div>
    HTML;
}
