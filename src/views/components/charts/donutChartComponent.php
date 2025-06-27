<?php
namespace Src\Views\Components\Charts;
function renderDonutChartComponent($seriesData, $labels, $title = 'Categorias', $mostPopular = 'Tecnologia') {
    if (empty($seriesData) || empty($labels)) {
        return '<p class="text-red-500">Erro: Dados ou rótulos não fornecidos.</p>';
    }

    $seriesDataJson = implode(',', $seriesData);
    $labelsJson = "'" . implode("','", $labels) . "'";
    $chartId = 'donut-chart-' . uniqid();

    $html = "
    <div class='container p-4'>

        <div class='bg-[#1B1B1B] rounded-xl shadow-lg overflow-hidden'>

            <div class='text-start text-white text-lg font-semibold py-2 ml-4'>$title</div>

            <div class='flex flex-col items-center justify-between p-4 pb-2'>

                <div id='$chartId' class='w-full md:w-3/5 z-0'></div>

                    <div class='w-full md:w-1/2 mt-1 md:mt-0 md:ml-4 flex flex-col items-center relative z-10 -mt-6'>

                        <div class='text-center text-white text-3xl font-semibold mt-4'>$mostPopular</div>

                        <div class='text-center text-gray-400 text-lg mt-1'>A categoria mais popular</div>

                            <div class='flex justify-start space-x-4 py-4 mt-2'>
                                <div class='flex items-center'><span class='w-3 h-3 bg-yellow-400 rounded-full mr-2'></span>Tecnologia</div>
                                <div class='flex items-center'><span class='w-3 h-3 bg-green-400 rounded-full mr-2'></span>Moda</div>
                                <div class='flex items-center'><span class='w-3 h-3 bg-purple-600 rounded-full mr-2'></span>Estatística</div>
                                <div class='flex items-center'><span class='w-3 h-3 bg-blue-400 rounded-full mr-2'></span>Saúde</div>
                            </div>
                    </div>
            </div>
        </div>

    </div>
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
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
                    donut: { size: '90%', labels: { show: false } }
                }
            },
            stroke: { width: 0, curve: 'smooth' },
            dataLabels: { enabled: false },
            legend: { show: false },
            tooltip: { theme: 'dark', enabled: true }
        };

        var chart = new ApexCharts(document.querySelector('#$chartId'), options);
        chart.render();
    </script>";

    return $html;
}
?>