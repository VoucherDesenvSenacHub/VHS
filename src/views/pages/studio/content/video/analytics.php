<?php
require_once __DIR__ . "/../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../components/utils/userActivityCardsComponent.php";
require_once __DIR__ . "/../../../../components/charts/chartComponent.php";
require_once __DIR__ . "/../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../../application/utils/orderningWeekDayAnalytics.php";
require_once __DIR__ . "/../../../../../application/utils/formatViews.php";

use function Src\Application\Utils\formatViews;
use function src\views\components\Charts\renderChartComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function src\views\components\utils\UserActivityCardsComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\Header\HeaderComponent;
use function Src\Application\Utils\orderningWeekDayAnalytics;

$video = $_SESSION["page_data"]["video"];
$weeklyViews = $_SESSION["page_data"]["weeklyViews"];
$weeklyAvaliations = $_SESSION["page_data"]["weeklyAvaliations"];
$isGeneral = $_SESSION["page_data"]["isGeneral"] ?? false;
$latestVideos = $_SESSION["page_data"]["latestVideos"] ?? [];
$latestComments = $_SESSION["page_data"]["latestComments"] ?? [];
$followersCount = $_SESSION["page_data"]["followersCount"] ?? 0;

$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];
$id = $video['id'] ?? "";

$ordered_views = orderningWeekDayAnalytics($weeklyViews);
$ordered_avaliations = orderningWeekDayAnalytics($weeklyAvaliations);

// Date formatting for header
$weekDays = [
    'Sunday' => 'Domingo',
    'Monday' => 'Segunda-feira',
    'Tuesday' => 'Terça-feira',
    'Wednesday' => 'Quarta-feira',
    'Thursday' => 'Quinta-feira',
    'Friday' => 'Sexta-feira',
    'Saturday' => 'Sábado'
];
$months = [
    'January' => 'janeiro',
    'February' => 'fevereiro',
    'March' => 'março',
    'April' => 'abril',
    'May' => 'maio',
    'June' => 'junho',
    'July' => 'julho',
    'August' => 'agosto',
    'September' => 'setembro',
    'October' => 'outubro',
    'November' => 'novembro',
    'December' => 'dezembro'
];

$now = new DateTime();
$dayName = $weekDays[$now->format('l')];
$dayNumber = $now->format('d');
$monthName = $months[$now->format('F')];

$date = "{$dayName}, {$dayNumber} de {$monthName}!";

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $weeks = floor($diff->days / 7);
    $days = $diff->days - ($weeks * 7);

    $string = array(
        'y' => 'ano',
        'm' => 'mês',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );

    $values = [
        'y' => $diff->y,
        'm' => $diff->m,
        'w' => $weeks,
        'd' => $days,
        'h' => $diff->h,
        'i' => $diff->i,
        's' => $diff->s,
    ];

    foreach ($string as $k => &$v) {
        if ($values[$k]) {
            $v = $values[$k] . ' ' . $v . ($values[$k] > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? 'há ' . implode(', ', $string) : 'agora';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - <?= htmlspecialchars($video["title"] ?? "Canal") ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
    <?= HeaderComponent(); ?>

    <div class="flex flex-col md:flex-row w-full">
        <div>
            <?= StudioSideMenuComponent() ?>
        </div>

        <div class="flex flex-col md:flex-row w-full">

            <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Analytics</h1>
                        <p class="text-gray-400 mt-1">Análise de dados do seu vídeo</p>
                    </div>

                    <div class="flex p-1 bg-[#121214] border border-white/5 rounded-xl">
                        <a href="/VHS/studio/content/video/edit?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-gray-400 shadow-lg transition-all">
                            Edição
                        </a>
                        <a href="/VHS/studio/content/video/commentary?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            Comentários
                        </a>
                        <a href="/VHS/studio/content/video/analytic?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-white bg-purple-600 hover:text-white hover:bg-white/5 transition-all">
                            Analytics
                        </a>
                    </div>
                </div>

                <!-- Video Specific Analytics Layout -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                    <!-- Left Column (Stats + Charts) -->
                    <div class="xl:col-span-2 space-y-8">

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <?= UserActivityCardsComponent("Visualizações", $video['views'] ?? 0) ?>
                            <?= UserActivityCardsComponent("Comentários", $video['comments'] ?? 0) ?>
                            <?= UserActivityCardsComponent("Média Vis.", $video['avg_views'] ?? 0) ?>
                            <?= UserActivityCardsComponent("Compartilhados", $video['shared'] ?? 0) ?>
                        </div>

                        <!-- Charts -->
                        <div class="grid grid-cols-1 gap-8">
                            <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">
                                <h3 class="text-lg font-semibold mb-4 text-gray-200">Desempenho Semanal</h3>
                                <?= renderChartComponent($ordered_views, $categoriesLine, 'Semana', 'Visualização', 'area') ?>
                            </div>

                            <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">
                                <h3 class="text-lg font-semibold mb-4 text-gray-200">Avaliações</h3>
                                <?= renderChartComponent($ordered_avaliations, $categoriesLine, 'Semana', 'Avaliação', 'bar') ?>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (Video Info) -->
                    <div class="xl:col-span-1">
                        <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl sticky top-24">
                            <div class="relative aspect-video rounded-xl overflow-hidden mb-4 group">
                                <img src="<?= htmlspecialchars($video["thumbnail_url"] ?? "") ?>" alt="" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-2 line-clamp-2"><?= $video["title"] ?? "" ?></h3>

                            <div class="flex items-center gap-4 text-sm text-gray-400 mb-4 border-b border-white/5 pb-4">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <?= $video['views'] ?? 0 ?>
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <?= $video['comments'] ?? 0 ?>
                                </span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">Descrição</h4>
                                    <p class="text-sm text-gray-300 leading-relaxed line-clamp-6 hover:line-clamp-none transition-all">
                                        <?= $video['description'] ?? "Sem descrição" ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </main>
        </div>
</body>

</html>