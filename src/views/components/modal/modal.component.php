<?php

namespace Src\Views\Components\Modal;

function ModalComponent(string $title, string $description)
{

    return <<<HTML
        <div>
            <div>
                <h2>{$title}</h2>
                <p>$description</p>
            </div>
            <div>
                <?= ButtonComponent() ?>
            </div>
        </div>   
    HTML;
}
