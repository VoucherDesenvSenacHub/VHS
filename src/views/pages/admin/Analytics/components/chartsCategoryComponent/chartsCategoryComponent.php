<?php

namespace Src\Views\Components;

function chartsCategoryComponent($seriesData, $labels, $title = 'Categorias', $mostPopular = 'Tecnologia')
{
    if (empty($seriesData) || empty($labels)) {
        return '<p class="text-red-500">Erro: Dados ou rótulos não fornecidos.</p>';
    }

    $seriesDataJson = implode(',', $seriesData);
    $labelsJson = "'" . implode("','", $labels) . "'";
    $chartId = 'donut-chart-' . uniqid();

    $colors = ['#FBBF24', '#34D399', '#A78BFA', '#60A5FA', '#F87171', '#4ADE80', '#818CF8'];

    $legendsHtml = "";
    foreach ($labels as $index => $label) {
        $color = $colors[$index % count($colors)];
        $legendsHtml .= "
            <div class='flex items-center'>
                <span class='w-3 h-3 rounded-full mr-2' style='background: {$color}'></span>{$label}
            </div>
        ";
    }

    $colorsJson = "'" . implode("','", array_slice($colors, 0, count($labels))) . "'";

    $html = <<<HTML
    <div class='w-full'>
        <div class='relative w-full h-[200px]'>
            <div id='{$chartId}' class='w-full absolute max-h-[200px]'></div>
            <div class='absolute flex flex-col items-center justify-center top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-[30%] text-center pointer-events-none w-full'>
                <text class='text-2xl font-semibold text-white cursor-default'>{$mostPopular}</text>
                <div class='text-gray-400 text-base'>A categoria mais popular</div>
            </div>
        </div>

        <div class='flex justify-center flex-wrap gap-4 mb-2 text-white'>
            {$legendsHtml}
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
                height: 300,
                background: 'transparent',
                toolbar: { show: false }
            },
            series: [{$seriesDataJson}],
            labels: [{$labelsJson}],
            colors: [{$colorsJson}],
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 90,
                    donut: {
                        size: '85%',
                        labels: { show: false }
                    }
                }
            },
            stroke: { width: 0 },
            dataLabels: { enabled: false },
            legend: { show: false },
            tooltip: { theme: 'dark', enabled: true }
        };

        var chart = new ApexCharts(document.querySelector('#{$chartId}'), options);
        chart.render();
    </script>
    HTML;

    return $html;
}
