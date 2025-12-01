<?php

namespace Src\Views\Components\Modal;

require_once __DIR__ . '/../utils/buttonComponent.php';

use function Src\Views\Components\Utils\ButtonComponent;

function ModalComponent (
    string $title,
    string $description,
    string $cancelLink,
    string $confirmLink
) {

    return <<<HTML
        <style>
            body {
                overflow: hidden;
            }
        </style>

        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="border border-[#666] rounded-xl shadow-lg p-6 w-[400px] text-white bg-gray600">
                <h2 class="text-xl font-bold">$title</h2>
                <p class="mb-6 text-[#666]">$description</p>
                <div class="flex justify-end gap-4">
    HTML
                    . ButtonComponent(text: "Agora não", variant: "outline", className: "btn-cancel w-[10.675rem] h-[2.5rem] outline-[#666]", link: $cancelLink)
                    . ButtonComponent(text: "Sim", variant: "default", className: "btn-confirm w-[10.675rem] h-[2.5rem]", link: $confirmLink)
                    .
    <<<HTML
                </div>
            </div>
        </div>
    HTML;
}
