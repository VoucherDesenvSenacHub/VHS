<?php

namespace Src\Views\Components\Utils;




// TODO: REFATORAR ESSE COMPONENTE
function Comment(string $id, string $name, string $text, ?string $created_at = null, ?string $userImg = null, bool $creatorLike = false)  {
    
    $userRole = $_SESSION["user"]["role"];
    $userName = $_SESSION["user"]["username"];

    $deleteOption = "";
    $editOption = "";
    $reportOption = "";
    
    
    $creatorLike = $creatorLike ? <<<HTML
        <img src="/VHS/public/icons/favorite-comment-filled.svg" alt="Curtir" class="w-7 h-7 absolute left-7 mt-10" alt="Curtido pelo criador">
    HTML : "";

    if($userName !== $name) {
        $reportOption = <<<HTML
            <li>
                <form action="/VHS/api/v1/comments/report?commentId=$id" method="post">
                    <button
                        type="submit"
                        role="menuitem"
                        data-action="report"
                        class="w-full text-left px-3 pt-1 flex items-center gap-3 text-xs font-semibold text-white transition"
                        >
                        <img src="/VHS/public/icons/comments/shield_warning.svg" alt="" class="w-5 h-5">
                        <span class="text-sm">Denunciar</span>
                    </button>
                </form>
            </li>
        HTML;
    }

    if($userName === $name) {
        $editOption = <<<HTML
            <li class="mb-2" onclick="handleEditComment(event, '$id')">
                <button
                type="button"
                role="menuitem"
                data-action="edit"
                class="w-full text-left px-3 pt-1 flex items-center gap-3 text-xs font-semibold text-white transition"
                >
                    <img src="/VHS/public/icons/comments_studio/pencil.svg" alt="" class="w-4 h-4">
                    <span class="text-sm">Editar</span>
                </button>
            </li>
        HTML;
    }

    if($userName === $name || $userRole === "ADMIN" || $userRole === "CREATOR") {
        $deleteOption = <<<HTML
            <li>
                <form action="/VHS/api/v1/comment/delete?commentId=$id" method="post">
                    <button
                    type="submit"
                    role="menuitem"
                    data-action="delete"
                    class="w-full text-left px-3 pt-1 flex items-center gap-3 text-xs font-semibold text-white transition"
                    >
                        <img src="/VHS/public/icons/comments_studio/trash.svg" alt="" class="w-4 h-4">
                        <span class="text-sm">Excluir</span>
                    </button>
                </form>
            </li>
        HTML;
    }


    $userImg = $userImg
        ? "<img src='/VHS/public/uploads/avatars/" . htmlspecialchars($userImg, ENT_QUOTES, 'UTF-8') . "' alt='Imagem de perfil' class='w-full h-full rounded-full mt-1 object-cover'>"
        : "<img src='/VHS/public/uploads/avatars/default.png' alt='Imagem padrão de perfil' class='w-full h-full rounded-full mt-1 object-cover'>";

    $created_at = $created_at ? "<p class='text-xs text-gray-300 font-semibold ml-1'>" . htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') . "</p>" : "";


    return <<<HTML
        <div class='w-full flex items-center gap-4 py-2 relative'>
            $creatorLike

            <div class='size-12  rounded-full mt-1 shrink-0'>
                $userImg
            </div>
    
            <div class='flex flex-col flex-1'>
                <div class='flex items-baseline'>
                    <p class='text-lg text-white font-semibold'>$name</p> 
                    $created_at
                </div>
    
                <div class='mt-1 text-xs font-medium text-gray-400 max-w-xl break-all' id='comment-content-$id'>
                    <p>$text</p>
                </div>
            </div>

            <div class="relative ml-3 mt-2">
                <button
                    type="button"
                    class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                    aria-haspopup="true"
                    aria-expanded="false"
                    onclick="toggleCommentOptions('$id')"
                    alt="Abrir opções" class="w-4 h-4">
                    <img src="/VHS/public/icons/comments_studio/ellipsis-vertical.svg" alt="Menu de opções">
                    <span class="sr-only">Abrir menu de opções</span>
                </button>

                <div
                    id="comment-options-$id"
                    class="absolute right-full top-0 mr-2 z-50 w-40 bg-gray-800 rounded border border-gray-700 shadow-lg hidden"
                    role="menu"
                    aria-hidden="true"
                    data-menu
                >
                    <ul class="pt-2" role="none">
                        $editOption
                        $deleteOption
                        $reportOption
                    </ul>
                </div>
            </div>
        </div>
        <script src='/VHS/src/views/components/utils/comments/script.js'></script>
        HTML;

}
