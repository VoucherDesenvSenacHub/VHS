<?php

namespace Src\Views\Components\Charts;

function renderChartComponent($seriesData, $categories, $title = 'Semana', $yAxisTitle = 'Usuários', $type = 'line')
{
    if (empty($seriesData) || empty($categories)) {
        return '<p class="text-red-500">Erro: Dados ou categorias não fornecidos.</p>';
    }

    $seriesDataJson = implode(',', $seriesData);
    $categoriesJson = "'" . implode("','", $categories) . "'";
    $chartId = 'chart-' . uniqid();

    // Determine colors based on type
    $primaryColor = '#9333ea'; // purple-600
    if ($type === 'bar') {
        $primaryColor = '#a855f7'; // purple-500
    }

    $html = "
    <div id='$chartId' class='w-full'></div>
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <script>
        (function() {
            var options = {
                chart: {
                    type: '$type',
                    height: 320,
                    fontFamily: 'Inter, sans-serif',
                    background: 'transparent',
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                series: [{
                    name: '{$yAxisTitle}',
                    data: [{$seriesDataJson}]
                }],
                colors: ['$primaryColor'],
                xaxis: {
                    categories: [{$categoriesJson}],
                    labels: {
                        style: {
                            colors: '#9ca3af', // gray-400
                            fontSize: '12px',
                            fontFamily: 'inherit'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#9ca3af', // gray-400
                            fontSize: '12px',
                            fontFamily: 'inherit'
                        },
                        formatter: function (value) {
                            return value >= 1000 ? (value / 1000).toFixed(1) + 'k' : value;
                        }
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    lineCap: 'round'
                },
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.05)',
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 10
                    }
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: '$type' === 'area' ? 'gradient' : 'solid',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                tooltip: {
                    theme: 'dark',
                    style: {
                        fontSize: '12px',
                        fontFamily: 'inherit'
                    },
                    x: {
                        show: true
                    },
                    y: {
                        formatter: function(value) {
                            return value;
                        }
                    },
                    marker: {
                        show: true,
                    },
                    background: '#18181b', // zinc-900
                    borderColor: '#27272a' // zinc-800
                },
                markers: {
                    size: 0,
                    colors: ['$primaryColor'],
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: {
                        size: 5
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector('#$chartId'), options);
            chart.render();
        })();
    </script>";

    return $html;
}
