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
        <div class="text-white rounded-lg p-5 flex flex-col gap-2 border border-gray-700" style="background-color: #1B1B1B">
            <div class='flex justify-between items-center'>
                <div class='flex items-center gap-2' >
                    <img src="$icon" alt="">
                    <p class="text-sm font-medium text-gray-400">$label</p>
                </div>
                <div class='flex items-center'>
                    <span class='text-xs font-medium text-green-500'>+12%</span>
                    <img src="/VHS/public/images/trendingUp.svg" alt="Seta para cima" class="w-4 h-4" />
                </div>
            </div>

            <p class="text-2xl font-bold text-white">$formattedValue</p>
        </div>
    HTML;
}
