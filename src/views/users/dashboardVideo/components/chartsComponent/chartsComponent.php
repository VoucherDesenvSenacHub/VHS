<?php

function chartsComponent($data = [])
{
    // Default data if none provided
    $defaultData = [
        'title' => 'Seguidores',
        'subtitle' => 'Crescimento semanal',
        'yAxisLabels' => ['12k', '9k', '6k', '3k', '0'],
        'xAxisLabels' => ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SÁB', 'DOM'],
        'dataPoints' => [
            ['x' => 0, 'y' => 120],
            ['x' => 85, 'y' => 110],
            ['x' => 170, 'y' => 80],
            ['x' => 255, 'y' => 40],
            ['x' => 340, 'y' => 70],
            ['x' => 425, 'y' => 85],
            ['x' => 510, 'y' => 75],
            ['x' => 600, 'y' => 65],
        ],
        'stats' => [
            ['value' => '+24%', 'label' => 'Crescimento'],
            ['value' => '8.4k', 'label' => 'Média Diária'],
            ['value' => '12.1k', 'label' => 'Pico Semanal'],
        ],
    ];

    $data = array_merge($defaultData, $data);

    // Generate SVG path for line and area
    $linePath = '';
    $areaPath = '';
    $firstPoint = true;
    foreach ($data['dataPoints'] as $index => $point) {
        $x = $point['x'];
        $y = $point['y'];
        if ($firstPoint) {
            $linePath .= "M $x $y";
            $areaPath .= "M $x $y";
            $firstPoint = false;
        } else {
            $prevX = $data['dataPoints'][$index - 1]['x'];
            $prevY = $data['dataPoints'][$index - 1]['y'];
            $controlX1 = $prevX + ($x - $prevX) / 2;
            $controlY1 = $prevY;
            $controlX2 = $prevX + ($x - $prevX) / 2;
            $controlY2 = $y;
            $linePath .= " Q $controlX1 $controlY1, $x $y";
            $areaPath .= " Q $controlX1 $controlY1, $x $y";
        }
    }
    $areaPath .= " L 600 200 L 0 200 Z";

    ob_start();
?>
    <div class="bg-[#1B1B1B] rounded-2xl p-4 sm:p-6 shadow-2xl border border-gray-700 w-full min-h-[24rem] max-h-[90vh] flex flex-col">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 sm:mb-8">
            <div class="animate-fade-in">
                <h2 class="text-white text-lg sm:text-xl font-semibold"><?php echo htmlspecialchars($data['title']); ?></h2>
                <p class="text-gray-400 text-xs sm:text-sm mt-1"><?php echo htmlspecialchars($data['subtitle']); ?></p>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.1s;">
                <span class="text-gray-300 text-xs sm:text-sm bg-gray-700 px-2 sm:px-3 py-1 rounded-full">Semana</span>
            </div>
        </div>

        <!-- Chart Container -->
        <div class="relative flex-grow min-h-[16rem]">
            <!-- Y-axis labels -->
            <div class="absolute left-0 top-0 h-full flex flex-col justify-between text-gray-400 text-xs sm:text-sm pr-2 sm:pr-4">
                <?php foreach ($data['yAxisLabels'] as $index => $label): ?>
                    <span class="animate-fade-in" style="animation-delay: <?php echo (0.2 + $index * 0.1); ?>s;"><?php echo htmlspecialchars($label); ?></span>
                <?php endforeach; ?>
            </div>

            <!-- Grid lines -->
            <div class="absolute left-6 sm:left-8 top-0 right-0 h-full">
                <div class="h-full relative">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <div class="absolute w-full h-px bg-gray-700 opacity-30" style="top: <?php echo $i * 25; ?>%"></div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Chart SVG -->
            <div class="absolute left-6 sm:left-8 top-0 right-0 h-full">
                <svg class="w-full h-full" viewBox="0 0 600 200" preserveAspectRatio="xMidYMid meet">
                    <!-- Gradient definition -->
                    <defs>
                        <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#8b5cf6;stop-opacity:1" />
                            <stop offset="50%" style="stop-color:#a855f7;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#c084fc;stop-opacity:1" />
                        </linearGradient>
                        <linearGradient id="areaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" style="stop-color:#8b5cf6;stop-opacity:0.3" />
                            <stop offset="100%" style="stop-color:#8b5cf6;stop-opacity:0" />
                        </linearGradient>
                    </defs>

                    <!-- Area under the curve -->
                    <path d="<?php echo htmlspecialchars($areaPath); ?>"
                        fill="url(#areaGradient)"
                        class="animate-fade-in"
                        style="animation-delay: 0.5s;" />

                    <!-- Main line -->
                    <path d="<?php echo htmlspecialchars($linePath); ?>"
                        stroke="url(#lineGradient)"
                        stroke-width="3"
                        fill="none"
                        stroke-linecap="round"
                        stroke-dasharray="1000"
                        stroke-dashoffset="1000"
                        class="animate-draw-line"
                        style="animation-delay: 0.8s;" />

                    <!-- Data points -->
                    <?php foreach ($data['dataPoints'] as $index => $point): ?>
                        <circle cx="<?php echo $point['x']; ?>" cy="<?php echo $point['y']; ?>" r="4" fill="#8b5cf6"
                            class="animate-scale-in" style="animation-delay: <?php echo (1.0 + $index * 0.1); ?>s;" />
                    <?php endforeach; ?>
                </svg>
            </div>
        </div>

        <!-- X-axis labels -->
        <div class="flex justify-between text-gray-400 text-xs sm:text-sm font-medium px-6 sm:px-8 mt-2 sm:mt-4">
            <?php foreach ($data['xAxisLabels'] as $index => $label): ?>
                <span class="animate-fade-in" style="animation-delay: <?php echo (0.7 + $index * 0.1); ?>s;"><?php echo htmlspecialchars($label); ?></span>
            <?php endforeach; ?>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-2 sm:gap-4 mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-gray-700">
            <?php foreach ($data['stats'] as $index => $stat): ?>
                <div class="text-center animate-fade-in" style="animation-delay: <?php echo (1.5 + $index * 0.1); ?>s;">
                    <div class="text-xl sm:text-2xl font-bold text-white"><?php echo htmlspecialchars($stat['value']); ?></div>
                    <div class="text-xs text-gray-400 mt-1"><?php echo htmlspecialchars($stat['label']); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        tailwind.config({
            theme: {
                extend: {
                    animation: {
                        'draw-line': 'draw-line 2s ease-out forwards',
                        'fade-in': 'fade-in 0.5s ease-in-out forwards',
                        'scale-in': 'scale-in 0.3s ease-out forwards',
                    },
                    keyframes: {
                        'draw-line': {
                            '0%': {
                                'stroke-dashoffset': '1000'
                            },
                            '100%': {
                                'stroke-dashoffset': '0'
                            }
                        },
                        'fade-in': {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        'scale-in': {
                            '0%': {
                                transform: 'scale(0)'
                            },
                            '100%': {
                                transform: 'scale(1)'
                            }
                        }
                    },
                }
            }
        });
    </script>
<?php
    return ob_get_clean();
}
?>