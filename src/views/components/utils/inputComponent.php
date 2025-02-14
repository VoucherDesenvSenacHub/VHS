<?php
 
    namespace Src\Views\Components\Utils;

    function InputComponent(string $type, string $placeholder, string $icon = null, string $label = null, string $description = null, string $background = null, string $iconPosition = null){
        
        $icon = $icon ? "<img src='$icon' class='absolute $iconPosition w-4 h-4 fill-blue-500'>" : "";
        
        $margin = "";

        $getPosition = explode("-",$iconPosition);
        if($getPosition[0] == "left"){
            $margin = "pl-10";
        }

        $label = $label ? "<label class='text-sm font-medium text-white mb-2'>$label</label>" : "";
        
        $description = $description ? "<p class='text-xs text-gray-200 mb-3'>$description</p>" : "";
        
        $background = $background ? "bg-$background" : "bg-transparent";

        return (
            "
            <div class='w-full'>
                <div class='flex flex-col mb-1'> 
                    $label
                    $description
                </div>
                <div class='relative mt-1 flex justify-center items-center'> 
                    <input type='$type' placeholder='$placeholder' 
                    class='w-full px-3 py-1.5 outline outline-1 outline-gray-500 rounded-md $background placeholder-slate-600 $margin text-zinc-200'
                    onfocus='this.placeholder=\"\"' 
                    onblur='this.placeholder=\"$placeholder\"
                    '>$icon
                </div>
            </div>
            "
        );
    }

