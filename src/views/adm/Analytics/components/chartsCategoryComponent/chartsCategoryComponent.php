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
    $html = "
    <div class='container'>
        <div class='bg-[#1B1B1B] flex flex-col justify-center gap-4 rounded-xl shadow-lg overflow-hidden p-6 border border-gray-600'>
            <div class='w-full flex justify-start'>
                <text class='text-2xl font-bold text-white cursor-default'>$title</text> 
            </div>
            <div class='relative w-full h-[200px]'>
                <div id='$chartId' class='w-full absolute max-h-[200px]'></div>
                <div class='absolute flex flex-col items-center justify-center top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-[30%] text-center pointer-events-none w-full'>
                    <text class='text-2xl font-semibold text-white cursor-default'>$mostPopular</text>
                    <div class='text-gray-400 text-base'>A categoria mais popular</div>
                </div>
            </div>
            <div class='flex justify-center flex-wrap gap-4 mb-2 text-white'>
                <div class='flex items-center'><span class='w-3 h-3 bg-yellow-400 rounded-full mr-2'></span>Tecnologia</div>
                <div class='flex items-center'><span class='w-3 h-3 bg-green-400 rounded-full mr-2'></span>Moda</div>
                <div class='flex items-center'><span class='w-3 h-3 bg-purple-600 rounded-full mr-2'></span>Estatística</div>
                <div class='flex items-center'><span class='w-3 h-3 bg-blue-400 rounded-full mr-2'></span>Saúde</div>
            </div>
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
            colors: ['#FBBF24', '#34D399', '#A78BFA', '#60A5FA'],
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
        var chart = new ApexCharts(document.querySelector('#$chartId'), options);
        chart.render();
    </script>";
    return $html;
}
