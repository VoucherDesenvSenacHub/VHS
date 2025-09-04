<?php

namespace Src\Views\Components\Utils;

function Comment(
    string $name,
    string $text,
    string $created_at = null,
    string $userImg = null,
    string $commentUserId = null,  
    string $loggedUserId = null,
    string $commentid
) {
    $userImg = $userImg
        ? "<img src='" . htmlspecialchars($userImg, ENT_QUOTES, 'UTF-8') . "' alt='Imagem de perfil' class='w-full h-full rounded-full mt-1 object-cover'>"
        : "<img src='https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg' alt='Imagem padrão de perfil' class='w-full h-full rounded-full mt-1 object-cover'>";

    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $created_at = $created_at 
        ? "<p class='text-xs text-gray-300 font-semibold ml-1'>" . htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') . "</p>" 
        : "";

    $readMoreButton = null;
    if (strlen($text) > 150) {
        $readMoreButton = "<button class='text-blue-400 text-xs mt-1 toggle-readmore self-start'>Ler mais</button>";
    }
    $comm = $commentid;
    $menu = "";
    if ($commentUserId === $loggedUserId) {
        $menu = "
        <div class='w-5 h-5 ml-3 mt-2 cursor-pointer relative opcoes self-start'>
            <img src='/VHS/public/icons/comments_studio/ellipsis-vertical.svg'>
            <div class='w-24 h-16 bg-gray-900 rounded-[0.5rem] flex items-center justify-center border-[0.1rem] border-solid border-purple-600  
            top-0 right-full mr-2 absolute hidden menu'>
                <ul class='w-full flex flex-col gap-3'>  
                    <li class='hover:bg-gray-700 text-white font-semibold flex w-16 h-5 text-xs gap-2 items-center ml-1'>
                        <form action='/VHS/src/application/routes/route.php/api/v1/home/video/delete' method='POST'>
                            <input type='hidden' name='action' value='delete_comment'>
                            <input type='hidden' name='comment_id' value='" . htmlspecialchars($comm) . "'>
                            <button type='submit' class='flex items-center gap-2 text-xs text-red-500'>
                                <img src='/VHS/public/icons/comments_studio/trash.svg'>
                                Excluir
                            </button>
                        </form>
                    </li>
                    <li class='hover:bg-gray-700 text-white font-semibold flex items-center w-16 h-5 text-xs gap-1 ml-1'>
                        <img src='/VHS/public/icons/comments_studio/pencil.svg'>
                        <p class='ml-1'>Editar</p>   
                    </li>
                </ul>    
            </div>
        </div>";
    }

    return "
        <div class='comment-container w-full flex items-center gap-4 py-2 mt-4'>
            <div class='size-12 self-start rounded-full mt-1 shrink-0'>
                $userImg
            </div>
    
            <div class='flex flex-col flex-1'>
                <div class='flex items-baseline gap-2'>
                    <p class='text-lg text-white font-semibold'>$name</p> 
                    $created_at
                </div>
    
                <div class='flex flex-col text-sm font-medium text-gray-400 break-all whitespace-pre-line max-w-fit inline-block'>
                    <p class='comment-text overflow-hidden max-h-16 transition-all duration-300'>$text</p>
                    $readMoreButton
                </div>
            </div>
            $menu
        </div>
       
    ";
}