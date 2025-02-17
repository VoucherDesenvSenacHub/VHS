<?php
    
    namespace Src\Views\Components\Utils;

    function ButtonComponent(string $text, bool $outline = false, string $icon = null, string $background = null, string $outiline_color = null, string $text_color = null) {
        
        $outline = $outline ? "!bg-transparent outline outline-1 outline-$outiline_color" : '';
        
        $outiline_color = $outiline_color ? "outiline-$outiline_color" : "";
        
        $icon = $icon ? "<img src='$icon' class='absolute left-3 w-4 h-4 fill-blue-500'>" : "";

        $text_color = $text_color ? "text-$text_color" : "";

        $background = $background ? "!bg-$background" : "bg-white";

        echo "
        <button class='flex justify-center items-center w-[380px] h-[50px] relative gap-2 rounded-md cursor-pointer $outline $background $text_color'>
            $icon
            $text
        </button>
        ";
    }