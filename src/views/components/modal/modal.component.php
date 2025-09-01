<?php

namespace Src\Views\Components\Modal;

function ModalComponent(string $title, string $description)
{

    return <<<HTML
        <div class="p-6 bg-black">
            <div>
                <h2>{$title}</h2>
                <p>$description</p>
            </div>
            <div>
                <?= ButtonComponent(text: "Cancelar", variant: "outline", width: 10.5) ?>
                <?= ButtonComponent(text: "Salvar Alterações", variant: "default", width: 10.5) ?>
            </div>
        </div>   
    HTML;
}
