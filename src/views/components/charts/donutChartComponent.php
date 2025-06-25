<?php
namespace Src\Views\Components\Charts;

function renderDonutChartComponent($seriesData, $labels, $title = 'Categorias', $mostPopular = 'Tecnologia') {
    // Validação básica dos dados
    if (empty($seriesData) || empty($labels)) {
        return '<p class="text-red-500">Erro: Dados ou rótulos não fornecidos.</p>';
    }

    // Converter arrays para strings JSON-like para JavaScript
    $seriesDataJson = implode(',', $seriesData);
    $labelsJson = "'" . implode("','", $labels) . "'";

    // Gerar um ID único para o gráfico
    $chartId = 'donut-chart-' . uniqid();

    // Construir a string do componente
    $html = "
    <div class='container mx-auto p-4'>
        <div class='bg-transparent rounded-xl shadow-lg' style='max-width: 100%; overflow: hidden;'>
            <div id='$chartId' class='p-4'></div>
            <div class='text-center text-white text-lg font-semibold mt-2'>$title</div>
            <div class='text-center text-gray-400 text-sm mt-1'>A categoria mais popular: $mostPopular</div>
            <div class='flex justify-center mt-4 space-x-4'>
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
                toolbar: {
                    show: false
                }
            },
            series: [{$seriesDataJson}],
            labels: [{$labelsJson}],
            colors: ['#FBBF24', '#34D399', '#A78BFA', '#60A5FA'], // Amarelo, Verde, Roxo, Azul
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 90,
                    donut: {
                        size: '70%',
                        labels: {
                            show: false
                        }
                    }
                }
            },
            stroke: {
                width: 0 // Remove bordas entre as seções
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            tooltip: {
                theme: 'dark',
                enabled: true
            }
        };

        var chart = new ApexCharts(document.querySelector('#$chartId'), options);
        chart.render();
    </script>";

    return $html;
}