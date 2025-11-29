<?php

namespace Src\Views\Components\Modal;

require_once __DIR__ . '/../utils/buttonComponent.php';

use function Src\Views\Components\Utils\ButtonComponent;

function RemoveVideoComponent(string $title, string $description, string $id)
{
    $cancelButton = ButtonComponent(
        text: "Cancelar",
        type: "button",
        variant: "outline",
        className: "btn-cancel w-[10.675rem] h-[2.5rem]",
        link: "/VHS/studio/content/video"
    );

    $confirmButton = ButtonComponent(
        text: "Confirmar",
        variant: "default",
        className: "btn-confirm w-[10.675rem] h-[2.5rem]"
    );

    return <<<HTML
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="border border-white rounded-xl shadow-lg p-6 w-[400px] text-white bg-[#1B1B1B]">
                <h2 class="text-xl font-bold mb-2 text-center">$title</h2>
                <p class="mb-4">$description</p>
                <form action="/VHS/api/v1/video/delete" method="post" class="flex justify-end gap-4">
                    <input type="hidden" name="id" value="$id">
                    $cancelButton
                    $confirmButton
                </form>
            </div>
        </div>
    HTML;
}
