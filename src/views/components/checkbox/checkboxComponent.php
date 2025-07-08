<?php

namespace App\Views\Components;

function CheckboxComponent(string $label, string $id = "checkbox") {
    return <<<HTML
        <div class="flex items-center gap-2 cursor-pointer" id="$id">
            <input type="checkbox" id="checkbox" class="hidden">
            <div id="customCheckbox" class="w-5 h-5 flex items-center justify-center bg-background rounded-md border border-gray300 transition-all">
                <svg id="checkIcon" class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <span class="cursor-default text-white text-base font-medium">
                $label
            </span>
            <script src="/VHS/src/views/components/checkbox/script.js"></script>
        </div>
    HTML;
}