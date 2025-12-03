<?php

namespace Src\Views\Components\Utils;

function InputComponent(
    string $type,
    string $placeholder,
    string $name = '',
    string $icon = null,
    string $label = null,
    string $label_size = null,
    string $description = null,
    string $description_size = null,
    string $background = null,
    string $iconPosition = "right", // Default to right
    string $width = "full",
    string $height = null,
    string $className = "",
    string $onClickIcon = "",
    bool $error = false,
    string $errorDescription = "",
    string $value = '',
    array $attributes = [],
    string $required = null
) {

    $type = htmlspecialchars(string: $type, flags: ENT_QUOTES, encoding: 'UTF-8');
    $placeholder = htmlspecialchars(string: $placeholder, flags: ENT_QUOTES, encoding: 'UTF-8');
    $name = htmlspecialchars(string: $name, flags: ENT_QUOTES, encoding: 'UTF-8');

    // Icon positioning logic
    $paddingClass = "";
    $iconPosClass = "";

    if ($icon) {
        if ($iconPosition === "left") {
            $paddingClass = "pl-10 pr-3";
            $iconPosClass = "left-3";
        } else {
            // Default to right if anything else or "right" is passed
            $paddingClass = "pr-10 pl-3";
            $iconPosClass = "right-3";
        }
    } else {
        $paddingClass = "px-3";
    }

    $iconHtml = $icon ? "<img onclick='$onClickIcon' src='" . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . "' class='absolute $iconPosClass w-5 h-5 transition-opacity opacity-50 hover:opacity-100 cursor-pointer'>" : "";

    // Label and Description
    $label_size = $label_size ? "text-$label_size" : "text-sm";
    $labelHtml = $label ? "<label class='$label_size font-medium text-gray-200'>" . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . "</label>" : "";

    $description_size = $description_size ? "text-$description_size" : "text-xs";
    $descriptionHtml = $description ? "<p class='$description_size text-gray-400'>" . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . "</p>" : "";

    // Base Input Styles
    // Using a more neutral base that can be easily overridden or looks good in dark mode
    $defaultStyles = "w-full bg-[#121214] border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-[#660BAD] focus:ring-1 focus:ring-[#660BAD] transition-all duration-300";

    if ($height) {
        $defaultStyles .= " h-$height";
    } else {
        $defaultStyles .= " py-3";
    }

    if ($error) {
        $defaultStyles .= " border-red-500 focus:border-red-500 focus:ring-red-500";
    }

    // Merge custom classes
    $finalInputClass = "$defaultStyles $paddingClass $className";

    $attributesInString = "";
    foreach ($attributes as $key => $attribute) {
        $attributesInString .= " $key='$attribute'";
    }

    $errorHtml = $error ?
        <<<HTML
            <p class="text-red-500 text-xs mt-1 font-medium flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                </svg>
                $errorDescription
            </p>
        HTML
        : "";

    return <<<HTML
        <div class='flex flex-col gap-1.5 w-full'>
            <div class='flex flex-col w-full gap-1'> 
                $labelHtml
                $descriptionHtml
            </div>
            <div class='relative flex items-center'> 
                <input 
                    name='$name' 
                    type='$type' 
                    placeholder='$placeholder' 
                    class='$finalInputClass' 
                    value='$value' 
                    $attributesInString
                >
                $iconHtml
            </div>
            $errorHtml
        </div>
    HTML;
}
