<?php
 
    namespace Src\Views\Components\Utils;

    function InputComponent(
        string $type, 
        string $placeholder, 
        string $icon = null, 
        string $label = null, 
        string $label_size = null,
        string $description = null, 
        string $description_size = null,
        string $background = null, 
        string $iconPosition = null,
        string $width = null
        ){
        
        $type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
        
        $placeholder = htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8');
        
        $icon = $icon ? "<img src='" . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . "' class='absolute $iconPosition w-4 h-4 fill-blue-500'>" : "";

        $margin = "";

        if (strpos($iconPosition, "left") !== false) {
            $margin = "pl-10";
        }
        elseif (strpos($iconPosition, "right") !== false) {
            $margin = "pr-10";
        }

        $label = $label ? "<label class='$label_size font-medium text-white mb-2'>" . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . "</label>" : "";

        $label_size = $label_size ? "text-[$label_size]" : "text-sm";
    
        $description = $description ? "<p class='$description_size text-gray-200 mb-3'>" . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . "</p>" : "";
        
        $description_size = $description_size ? "text-[$description_size]" : "text-xs";

        $classes = [
            "!px-3 py-1.5 outline outline-1 outline-gray-500 rounded-md placeholder-slate-600 text-zinc-200 h-[35px]",
            $width = $width ? "w-[$width]" : "w-full",
            $background ? "bg-$background" : "bg-transparent",
            $margin
        ];

        $input_style = implode(" ", array_filter($classes));

        return (
            "
            <div class='w-full'>
                <div class='flex flex-col mb-1'> 
                    $label
                    $description
                </div>
                <div class='relative mt-1 flex justify-center items-center'> 
                    <input type='$type' placeholder='$placeholder' class='$input_style'onfocus='this.placeholder=\"\"' onblur='this.placeholder=\"$placeholder\"'>
                    $icon
                </div>
            </div>
            "
        );
    }

