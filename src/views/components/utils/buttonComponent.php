<?php
    
    namespace Src\Views\Components\Utils;

    function ButtonComponent(string $text, bool $outline = false, string $outiline_color = null, string $icon = null, string $background = null, string $text_color = null, string $font_size = null) {
        
        $outline = $outline ? "!bg-transparent outline outline-1 $outiline_color" : '';
        
        $outiline_color = $outiline_color ? "outiline-$outiline_color" : "";
        
        $icon = $icon ? "<img src='$icon' class='w-4 h-4'>" : "";

        $background = $background ? "!bg-$background" : "bg-white";
        
        $text_color = $text_color ? "text-$text_color" : "";

        $font_size = $font_size ? "text-[$font_size]" : "";

        echo "
        <button class='flex justify-center items-center w-[380px] h-[50px] gap-2 rounded-md cursor-pointer $outline $background $text_color $font_size'>
            $icon
            $text
        </button>
        ";
    }