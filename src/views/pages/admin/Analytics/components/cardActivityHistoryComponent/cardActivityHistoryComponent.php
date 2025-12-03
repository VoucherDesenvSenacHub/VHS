<?php

namespace Src\Views\Components;

function cardActivityHistoryComponent($atividades)
{
    $atividadesPorData = [];
    foreach ($atividades as $atividade) {
        $data = $atividade['data'];
        if (!isset($atividadesPorData[$data])) {
            $atividadesPorData[$data] = [];
        }
        $atividadesPorData[$data][] = $atividade;
    }

    $html = "<div class='flex flex-col gap-4 max-h-[36vh] overflow-y-auto custom-scroll'>";
    foreach ($atividadesPorData as $data => $atividadesDoDia) {
        $html .= "<div class='space-y-2'>";
        $html .= "<text class='text-sm font-semibold text-gray-400'>{$data}</text>";
        $html .= "<div class='flex flex-col gap-2'>";
        foreach ($atividadesDoDia as $atividade) {
            $html .= "<div class='flex justify-start items-center gap-2 w-full'>";
            $html .= "<span class='text-muted-foreground min-w-[40px]'>{$atividade['time']}</span>";
            $html .= "<div class='flex gap-2 text-base text-gray-100 leading-snug'>";
            $html .= "<p><span class='font-semibold text-purple-400'>{$atividade['usuario1']} </span>{$atividade['description']} <span class='font-semibold text-purple-400'>{$atividade['usuario2']}</span>, por motivo: <br><span class='font-bold text-indigo-300'>{$atividade['causa']}</span>.</p>";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= "</div>";
        $html .= "</div>";
    }
    $html .= "</div>";
    $html .= "<style>
        .custom-scroll {
            overflow-y: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .custom-scroll::-webkit-scrollbar {
            display: none;
        }
    </style>";

    return $html;
}
