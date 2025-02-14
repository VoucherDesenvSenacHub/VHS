<?php
    
    namespace Src\Components\Utils;

    function buttonComponent(bool | null $outline, string $text, string | null $icon, string $background) {
        $outline = $outline ? "bg-none  outline-solid outline-purple-500" : '';
        $icon = $icon ? "<img src='$icon' class='w-8 h-8'/>" : '';

        echo "
        <button class='flex justify-center items-center w-[380px] h-[50px] $outline $background'>
            $icon
            $text
        </button>
        ";
    }