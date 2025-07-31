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
    <div class='container'>
        <div class='bg-[#1B1B1B] rounded-xl shadow-lg overflow-hidden p-4 border border-gray-600'>
            <div class='text-start text-white text-xl font-semibold py-2 ml-4'>$title</div>

            <div class='relative w-full md:w-3/5 mx-auto h-[200px] mt-6'>
                <div id='$chartId' class='w-full absolute z-0 ml-7'></div>

                <div class='absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-[30%] text-center z-10 pointer-events-none w-full'>
                    <div class='text-white text-3xl font-semibold'>$mostPopular</div>
                    <div class='text-gray-400 text-lg mt-1'>A categoria mais popular</div>
                </div>
            </div>

            <div class='flex justify-center flex-wrap gap-4 text-white py-4 mt-4'>
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
?>
