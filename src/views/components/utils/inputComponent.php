<?php
 
    namespace Src\Views\Components\Utils;

    function inputComponent(String $icon = "", String $type, String $label = "", String $placeholder, String $description = ""){
        
        $labelHtml = !empty($label) ? "<label class='text-sm font-medium text-gray-700'>$label</label>" : "";
        
        $descriptionHtml = !empty($description) ? "<p class='text-xs text-gray-500'>$description</p>" : "";

        $iconHtml = !isset($icon) ? "<span class='absolute inset-y-0 left-3 flex items-center text-gray-400'>$icon</span>" : "";

        return (
            "
            <div class='w-full'>
                <div class='flex flex-col mb-1'> 
                    $labelHtml
                    $descriptionHtml
                </div>
                <div class='relative mt-1' > 
                    $iconHtml
                    <input type='$type' placeholder='$placeholder' class='w-full pr-3 py-2'>
                </div>
            </div>
            "
        );
    }

