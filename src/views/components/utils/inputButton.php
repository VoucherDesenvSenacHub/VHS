<?php
 
    namespace Src\Views\Components\Utils;

    function inputButton(string $icon = "", String $type, String $label = "", String $placeholder, String $description = ""){
        return (
            "
            <div class='w-full'>
                <div class='flex flex-col mb-1'> 
                    <label>$label</label>
                    <p>$description</p>
                </div>
                <div class='relative mt-1' > 
                    <span class='absolute inset-y-0 left-3 flex item-center text-gray-400'>
                    $icon
                    </span>
                    <input type='$type' placeholder='$placeholder' class='w-full pr-3 py-2'>
                </div>
            </div>
            "
        );
    }
?>


<!-- <?php

// namespace Src\Views\Components\Utils;

// class Input
// {
//     public static function render(string $icon = "", string $type, string $label = "", string $placeholder, string $description = "")
//     {
//         // Criando a label apenas se for fornecida
//         $labelHtml = !empty($label) ? "<label class='text-sm font-medium text-gray-700'>$label</label>" : "";

//         // Criando a descrição apenas se for fornecida
//         $descriptionHtml = !empty($description) ? "<p class='text-xs text-gray-500'>$description</p>" : "";

//         // Criando o ícone apenas se for fornecido
//         $iconHtml = "";
//         if (!empty($icon)) {
//             $iconHtml = "<span class='absolute inset-y-0 left-3 flex items-center text-gray-400'>$icon</span>";
//         }

//         return "
//         <div class='w-full'>
//             <div class='flex flex-col mb-1'> 
//                 $labelHtml
//                 $descriptionHtml
//             </div>
//             <div class='relative mt-1'> 
//                 $iconHtml
//                 <input type='$type' placeholder='$placeholder' class='w-full pr-3 py-2 pl-10 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm'>
//             </div>
//         </div>";
//     }
// } 
?>
 -->
