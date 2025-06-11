<?php
 
namespace Src\Views\Components\Utils;
 
function Comment(string $name, string $text, string $thumbnail_url, string $created_at = null, string $userImg = null)
{
    $userImg = $userImg
        ? "<img src='" . htmlspecialchars($userImg, ENT_QUOTES, 'UTF-8') . "' alt='Imagem de perfil' class='w-full h-full rounded-full mt-1'>"
        : "<img src='https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg' alt='Imagem padrão de perfil' class='w-full h-full rounded-full mt-1'>";
 
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
 
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
 
    $created_at = $created_at ? "<p class='text-xs text-gray-300 font-semibold ml-1'>" . htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') . "</p>" : "";
 
    return (
        "
        <div class='w-full flex gap-4 py-2'>
            <div class='w-14 h-14 rounded-full mt-1 shrink-0'>
                $userImg
            </div>
   
            <div class='flex flex-col flex-1'>
                <div class='flex items-baseline'>
                    <p class='text-lg text-white font-semibold'>$name</p>
                    $created_at
                </div>
   
                <div class='mt-1 text-xs font-semibold text-gray-400 max-w-xl'>
                    <p>$text</p>
                </div>
               
                <div class='mt-2'>
                    <ul class='w-full flex gap-3'>  
                        <li>
                            <img src='/VHS/public/icons/comments/dialog.svg'>
                        </li>
                        <li>
                            <img src='/VHS/public/icons/comments/Trash.svg'>
                        </li>
                        <li>
                            <img src='/VHS/public/icons/comments/user-block.svg'>
                        </li>
                    </ul>    
                </div>

                
                </div>
                <div> <img class='h-20' src='$thumbnail_url' alt=''> </div>
        </div>
        "
    );
}

