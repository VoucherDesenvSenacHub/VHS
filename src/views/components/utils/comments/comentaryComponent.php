<?php

namespace Src\Views\Components\Utils;

// TODO: REFATORAR ESSE COMPONENTE
function Comment(string $name, string $text, string $created_at = null, string $userImg = null)
{

    $userImg = $userImg
        ? "<img src='" . htmlspecialchars($userImg, ENT_QUOTES, 'UTF-8') . "' alt='Imagem de perfil' class='w-full h-full rounded-full mt-1 object-cover'>"
        : "<img src='https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg' alt='Imagem padrão de perfil' class='w-full h-full rounded-full mt-1 object-cover'>";

    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

    $created_at = $created_at ? "<p class='text-xs text-gray-300 font-semibold ml-1'>" . htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') . "</p>" : "";

    return (
        "
        <div class='w-full flex items-center  gap-4 py-2'>
            <div class='size-12  rounded-full mt-1 shrink-0'>
                $userImg
            </div>
    
            <div class='flex flex-col flex-1'>
                <div class='flex items-baseline'>
                    <p class='text-lg text-white font-semibold'>$name</p> 
                    $created_at
                </div>
    
                <div class='mt-1 text-xs font-medium text-gray-400 max-w-xl'>
                    <p>$text</p>
                </div>
            </div>

            <div class='w-5 h-5 ml-3 mt-2 cursor-pointer relative opcoes'>
                <img src='/VHS/public/icons/comments_studio/ellipsis-vertical.svg'>
                <div class='w-24 h-16 bg-gray-800 rounded-[0.22rem] flex items-center justify-center border-[0.1rem] border-solid border-gray-600 
                top-0 right-full mr-4 absolute hidden menu'>
                    <ul class='w-full flex flex-col gap-3'>  
                        <li class='hover:bg-gray-700 text-white font-semibold flex w-16 h-5 text-xs gap-2 items-center ml-1'>
                            <img src='/VHS/public/icons/comments_studio/trash.svg'>
                            <p class='text-red-500'>Excluir</p>
                        </li>
                        <li class='hover:bg-gray-700 text-white font-semibold flex items-center w-16 h-5 text-xs gap-1 ml-1'>
                            <img src='/VHS/public/icons/comments_studio/pencil.svg'>
                            <p class='ml-1'>Editar</p>   
                        </li>
                    </ul>    
                </div>
            </div>
        </div>
        <script src='/VHS/src/views/components/utils/comments/script.js'></script>
        "
    );
}
