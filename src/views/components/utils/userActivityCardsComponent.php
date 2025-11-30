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

    // Determine icon based on label if not provided
    if (!$icon) {
        switch (mb_strtolower($label, 'UTF-8')) {
            case 'visualizações':
            case 'média vis.':
                $icon = '<svg class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>';
                break;
            case 'comentários':
                $icon = '<svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>';
                break;
            case 'compartilhados':
                $icon = '<svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" /></svg>';
                break;
            case 'seguidores':
                $icon = '<svg class="w-5 h-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>';
                break;
            case 'avaliações':
            case 'm. avaliações':
                $icon = '<svg class="w-5 h-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>';
                break;
            default:
                $icon = '<svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>';
        }
    } else {
        // If icon is passed as image URL (legacy support or specific overrides)
        if (strpos($icon, '<svg') === false) {
            $icon = "<img src=\"$icon\" alt=\"\" class=\"w-5 h-5\">";
        }
    }

    echo <<<HTML
        <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
            <div class="relative bg-[#121214] border border-white/5 rounded-2xl p-5 h-28 flex flex-col justify-between transition-all duration-300 group-hover:border-purple-500/30 group-hover:-translate-y-1">
                <div class="flex justify-between items-start">
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">$label</span>
                    <div class="p-2 bg-white/5 rounded-lg group-hover:bg-white/10 transition-colors">
                        $icon
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-2xl font-bold text-white tracking-tight">$formattedValue</h3>
                    <!-- Optional: Add trend indicator here if available in future -->
                </div>
            </div>
        </div>
    HTML;
}
