<?php

namespace Src\Views\Components\Modal;

require_once __DIR__ . '/../utils/buttonComponent.php';

use function Src\Views\Components\Utils\ButtonComponent;

function ModalComponent(string $title, string $description)
{
    return <<<HTML
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="border border-white rounded-xl shadow-lg p-6 w-[400px] text-white">
                <h2 class="text-xl font-bold mb-2">$title</h2>
                <p class="mb-4">$description</p>
                <div class="flex justify-end gap-4">
    HTML
        . ButtonComponent(text: "Cancelar", variant: "outline", width: 10.5, className: "btn-cancel", link: '/VHS/home')
        . ButtonComponent(text: "Confimar", variant: "default", width: 10.5, className: "btn-confirm", link: '/VHS/create/video')
        . <<<HTML
                </div>
            </div>
        </div>
    HTML;
}
