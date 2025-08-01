<?php

namespace Src\Views\Components\Utils;

function formatViews($viewsCont)
{
    if (!is_numeric($viewsCont)) {
        return '0';
    }
    if ($viewsCont >= 1000000) {
        return number_format($viewsCont / 1000000, 1) . 'M';
    } elseif ($viewsCont >= 1000) {
        return number_format($viewsCont / 1000, 0) . 'k';
    }
    return strval($viewsCont);
}

function UserActivityCardsComponent(
    $label = 'Visualizações',
    $value = 0,
    $icon = null
) {
    $formattedValue = is_numeric($value) ? formatViews($value) : $value;

    $label = htmlspecialchars($label);
    $formattedValue = htmlspecialchars($formattedValue);

    echo <<<HTML
        <div class="text-white rounded-xl p-4 flex justify-between items-center w-48 border border-gray-600" style="background-color: #1B1B1B">
            <div>
                <p class="text-sm text-gray-400">$label</p>
                <p class="text-2xl font-semibold">$formattedValue</p>
            </div>

            <p class="text-2xl font-bold text-white">$formattedValue</p>
        </div>
    HTML;
}
