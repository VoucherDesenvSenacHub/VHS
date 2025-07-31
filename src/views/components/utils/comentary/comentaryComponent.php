<?php

namespace Src\Views\Components\Utils;

function Comment(string $name, string $text, string $created_at = null, string $userImg = null)
{

    $userImg = $userImg
        ? "<img src='" . htmlspecialchars($userImg, ENT_QUOTES, 'UTF-8') . "' alt='Imagem de perfil' class='w-full h-full rounded-full mt-1'>"
        : "<img src='https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg' alt='Imagem padrão de perfil' class='w-full h-full rounded-full mt-1'>";

    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

    $created_at = $created_at ? "<p class='text-xs text-gray-300 font-semibold ml-1'>" . htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') . "</p>" : "";

    return (
        "
        <div class='max-w-1/2 h-28 block flex'>
            <div class='w-14 h-14 rounded-full mt-1'>
                $userImg
            </div>

            <div class='block ml-3'>
            
                <div class='max-w-80 h-5 flex items-baseline'>
                    <p class='text-lg text-white font-semibold'>$name</p> 
                    <p class='text-base text-gray-300 font-semibold ml-1'>$created_at</p>
                </div>

                <div class='max-w-md h-20 mt-1 text-xs font-semibold text-gray-400'>
                    <p>$text</p>
                </div>

            </div>

            <div class='size-20 ml-9 mt-2 cursor-pointer relative' id='opcoes'>
                <img src='/Voucher-dev-142-VHS/public/icons/comments/ellipsis-vertical.svg'>
            <div>
        </div>
        <div class='w-24 h-16 bg-gray-800 rounded-[0.22rem] flex items-center justify-center border-[0.1rem] border-solid border-gray-600 
        top-0 ml-5 absolute hidden' id='menu'>
            <ul class='w-full flex flex-col gap-3'>  
                <li class='hover:bg-gray-700 text-white font-semibold flex w-16 h-5 text-xs gap-2 items-center ml-1'>
                    <div>
                        <img src='/Voucher-dev-142-VHS/public/icons/comments/trash.svg'>
                    </div>
                    <div class='text-red-500'>
                        <p>Excluir</p>
                    </div>
                </li>
                <li class=' hover:bg-gray-700 text-white font-semibold flex items-center w-16 h-5 text-xs gap-1 ml-1'>
                    <div>
                        <img src='/Voucher-dev-142-VHS/public/icons/comments/pencil.svg'>
                    </div>
                    <div class='ml-1'>
                        <p>Editar</p>   
                    </div>
                </li>
                
            </ul>    
        </div>

        <script src='/Voucher-dev-142-VHS/src/views/components/utils/comentary/script.js'></script>
        "
    );
}
