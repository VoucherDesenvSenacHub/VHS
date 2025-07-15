<?php
namespace Src\Views\Components\Charts;

function renderChartComponent($seriesData, $categories, $title = 'Semana', $yAxisTitle = 'Usuários') {
    // Validação básica dos dados
    if (empty($seriesData) || empty($categories)) {
        return '<p class="text-red-500">Erro: Dados ou categorias não fornecidos.</p>';
    }

    // Converter arrays para strings JSON-like para JavaScript
    $seriesDataJson = implode(',', $seriesData);
    $categoriesJson = "'" . implode("','", $categories) . "'";

    // Gerar um ID único para o gráfico
    $chartId = 'chart-' . uniqid();

    // Construir a string do componente
    $html = "
    <div class='container p-4 bg-[#1B1B1B] rounded-2xl'>
        <div id='$chartId' class='bg-[#1B1B1B] rounded-2xl shadow-lg'></div>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <script>
        var options = {
            chart: {
                type: 'line',
                height: 300,
                background: '#1B1B1B',
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: '{$yAxisTitle}',
                data: [{$seriesDataJson}]
            }],
            xaxis: {
                categories: [{$categoriesJson}],
                labels: {
                    style: {
                        colors: '#fff',
                        fontSize: '12px'
                    },
                    show: true
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                title: {
                    text: '{$yAxisTitle}',
                    style: {
                        color: '#fff',
                        fontSize: '12px'
                    }
                },
                labels: {
                    style: {
                        colors: '#fff',
                        fontSize: '12px'
                    },
                    show: true
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            title: {
                text: '{$title}',
                align: 'right',
                style: {
                    color: '#fff'
                }
            },
            stroke: {
                curve: 'smooth',
                width: 4,
                colors: ['#BF00FF'],
                lineCap: 'round'
            },
            grid: {
                borderColor: '#444',
                show: false
            },
            dataLabels: {
                enabled: false
            },
            tooltip: {
                theme: 'dark'
            },
            plotOptions: {
                line: {
                    dropShadow: {
                        enabled: true,
                        color: '#BF00FF',
                        top: 0,
                        left: 0,
                        blur: 5,
                        opacity: 0.6
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector('#$chartId'), options);
        chart.render();
    </script>";

    return $html;
}