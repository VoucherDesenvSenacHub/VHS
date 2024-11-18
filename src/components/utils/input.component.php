<?php

namespace Src\Components\Utils;

function inputComponent(string | null $title, string | null $description, string | null $label, string $placeholder, string | null $icon) {
    $title = $title ? "<h2 class='input-title'>$title</h2>" : '';
    $description = $description ? "<p class='input-description'>$description</p>" : '';
    $label = $label ? "<label for='input'>$label</label>" : '';
    $icon = $icon ? "<img src='$icon' class='icon'/>" : '';
    
    echo "
    <div>
        $title
        $description
        $label
        <div class='input-control'>
            <input type='text' placeholder='$placeholder'/>
            $icon
        </div>
    </div>

    <style>
        div.input-control {
            display: flex;
            align-items: center;
            position: relative;
        }

        div.input-control > .icon {
            position: absolute;
            right: 0.5rem;
        }

        h2.input-title {
            font-size: var(--subtitle-size);
            color: white;
        }

        p.input-description {
            font-size: var(--paragraph-size);
            color: var(--gray-200);
            padding-bottom: 0.5rem;
        }

        input {
            transition: all ease-in 0.3s;

            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0.4rem;
            padding-right: 2.5rem;
            width: 100%;
            background: none;

            border: var(--border-input);
            font-size: var(--paragraph-size);
            color: var(--gray-200);
        }

        input:focus {
            outline: 1px solid #ccc;
        }
    </style>
    ";
}
?>