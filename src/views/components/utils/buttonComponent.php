<?php
    
    namespace Src\Views\Components\Utils;

    function ButtonComponent(string $text, string $variant ,string $icon = null) {
        
        $icon = $icon ? "<img src='$icon' class='w-4 h-4'>" : "";

        $button_style = "flex justify-center items-center w-[380px] h-[50px] gap-2 rounded-md cursor-pointer ";

        switch ($variant) {
            case 'outline':
                $button_style = $button_style . "outline outline-1 outline-purple-500 text-white";
                break;
            
            case 'icon':
                $button_style = $button_style . "bg-white";
                break;

            default:
                $button_style = $button_style . "bg-purple-700 text-white";
                break;
        }

        return(
            "
                <button class='$button_style'>
                    $icon
                    $text
                </button>
            "
        ); 
    }