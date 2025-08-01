<?php
 
    namespace Src\Views\Components\Utils;

    function InputComponent(
        string $type, 
        string $placeholder, 
        string $name,
        string $icon = null, 
        string $label = null, 
        string $label_size = null,
        string $description = null, 
        string $description_size = null,
        string $background = null, 
        string $iconPosition = null,
        string $width = null,
        string $height = null,
        string $className = "",
        string $onClickIcon = ""
        ){
        
        $type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
        
        $placeholder = htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8');

        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

        $orientationIcon = "";
        $padding = "";

        if (strpos($iconPosition, "left") !== false) {
            $padding = "pl-10";
            $orientationIcon = "left-2.5";
        }
        elseif (strpos($iconPosition, "right") !== false) {
            $padding = "pr-10";
            $orientationIcon = "right-2.5";
        }
        
        $icon = $icon ? "<img onclick='$onClickIcon' src='" . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . "' class='absolute $iconPosition w-5 h-5 fill-blue-500 $orientationIcon'>" : "";

        $label_size = $label_size ? "text-$label_size" : "text-md";
        
        $label = $label ? "<label class='$label_size font-medium text-white'>" . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . "</label>" : "";
        
        $description_size = $description_size ? "text-$description_size" : "text-sm";
       
        $description = $description ? "<p class='$description_size text-gray-200'>" . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . "</p>" : ""; 

        $classes = [
            "px-3 py-1.5 outline outline-1 outline-[#666666] rounded-md placeholder-[#666666] text-zinc-200",
            $width = $width ? "w-$width" : "w-full",
            $height = $height ? "h-$height" : "h-[45px]",
            $background ? "bg-$background" : "bg-transparent",
            $padding
        ];

        $input_style = implode(" ", array_filter($classes));

        return (
            "
            <div class='flex flex-col gap-2'>
                <div class='flex flex-col w-full gap-1'> 
                    $label
                    $description
                </div>
                <div class='relative flex justify-center items-center'> 
                    $icon
                    <input name='$name' type='$type' placeholder='$placeholder' class='$input_style $className'>
                </div>
            </div>
            "
        );
    }

