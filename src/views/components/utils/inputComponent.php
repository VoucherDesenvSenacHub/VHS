<?php
 
    namespace Src\Views\Components\Utils;

    function inputComponent(string | null $icon, string $type, string | null $label, string $placeholder, string | null $description){
        $icon = $icon ? "<img src='$icon'>" : "";
        $label = $label ? "<label class='text-sm font-medium text-gray-700'>$label</label>" : "";
        $description = $description ? "<p class='text-xs text-gray-500'>$description</p>" : "";

        // $labelHtml = !empty($label) ? "<label class='text-sm font-medium text-gray-700'>$label</label>" : "";
        
        // $descriptionHtml = !empty($description) ? "<p class='text-xs text-gray-500'>$description</p>" : "";

        // $iconHtml = !isset($icon) ? "<span class='absolute inset-y-0 left-3 flex items-center text-gray-400'>
        // <img src='$icon'>
        // </span>" : "";

        return (
            "
            <div class='w-full'>
                <div class='flex flex-col mb-1'> 
                    $label
                    $description
                </div>
                <div class='relative mt-1' > 
                    $icon
                    <input type='$type' placeholder='$placeholder' class='w-full pr-3 py-2'>
                </div>
            </div>
            "
        );
    }

