<?php

namespace Src\Views\Components\Utils;

function Comment(
    string $name,
    string $text,
    string $created_at = null,
    string $update_at = null,
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

    if ($update_at != $created_at){
        $edited = "<p class='mb-1 text-gray font-semibold text-xs opacity-25 self-end edit-validation'>(Editado)</p>";
    }

    $token = bin2hex(random_bytes(16));
    $_SESSION['delete_tokens'][$token] = $commentid;

    $menu = "";
    if ($commentUserId === $loggedUserId) {
        $menu = "
        <div class='w-5 h-5 ml-3 mt-2 cursor-pointer relative opcoes self-start'>
            <img src='/VHS/public/icons/comments_studio/ellipsis-vertical.svg'>
            <div class='w-24 h-20 bg-gray-900 rounded-[0.5rem] flex items-center justify-center   
            top-0 right-full mr-2 absolute hidden menu'>
                <ul class='flex flex-col items-center'>  
                    <li class='text-white font-semibold flex text-xs gap-1 w-24 h-10 rounded-[0.5rem] justify-center items-center hover:border-[0.1rem] hover:border-solid hover:border-purple-600'>
                        <form class='mt-2' action='/VHS/src/application/routes/route.php/api/v1/home/video/delete' method='POST'>
                            <input type='hidden' name='delete_token' value='$token'>
                            <button type='submit' class='flex items-center gap-2 text-xs text-red-500 w-full h-full'>
                                <img src='/VHS/public/icons/comments_studio/trash.svg'>
                                Excluir
                            </button>
                        </form>
                    </li>
                    <li class='edit-comment text-white font-semibold flex text-xs gap-1 w-24 h-10 rounded-[0.5rem] justify-center items-center hover:border-[0.1rem] hover:border-solid hover:border-purple-600'>
                    <button type='button' class='edit-comment flex items-center gap-2 text-xs text-blue-400' data-id='" . htmlspecialchars($commentid, ENT_QUOTES, 'UTF-8') . "'>
                        <img src='/VHS/public/icons/comments_studio/pencil.svg'>
                        Editar
                    </button>
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
                    $edited
                </div>
    
                <div class='flex flex-col text-sm font-medium text-gray-400 break-all whitespace-pre-line inline-block'>
                    <p class='comment-text overflow-hidden max-h-16 transition-all duration-300' data-id='" . htmlspecialchars($commentid, ENT_QUOTES, 'UTF-8') . "'>$text</p>
                    
                    $readMoreButton
                </div>
            </div>
            $menu
        </div>
    ";
}
