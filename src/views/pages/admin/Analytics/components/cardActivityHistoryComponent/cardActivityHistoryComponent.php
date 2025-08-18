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

    $html = "<div class='bg-[#1B1B1B] p-6 w-full rounded-xl border border-gray-700 space-y-4 font-[Poppins]'>";
    $html .= "<div class='flex justify-start w-full'>";
    $html .= "<text class='text-2xl font-bold text-white cursor-default'>Histórico de Atividades</text>";
    $html .= "</div>";
    $html .= "<div class='flex flex-col gap-4 max-h-[36vh] overflow-y-auto custom-scroll'>";
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
            overflow-y: auto; /* Ensure vertical scrolling is enabled */
            -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
        }
        .custom-scroll::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari, and newer Edge */
        }
        .video-image {
            transition: transform 0.3s ease;
        }
        .video-image-container:hover .video-image {
            transform: scale(1.1);
        }
    </style>";
    $html .= "</div>";

    return $html;
}