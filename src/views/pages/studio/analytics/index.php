<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/utils/userActivityCardsComponent.php";
require_once __DIR__ . "/../../../components/charts/chartComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../application/utils/orderningWeekDayAnalytics.php";
require_once __DIR__ . "/../../../../application/utils/formatViews.php";

use function Src\Application\Utils\formatViews;
use function Src\Views\Components\Charts\renderChartComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\UserActivityCardsComponent;
use function Src\Views\Components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\Application\Utils\orderningWeekDayAnalytics;

$video = $_SESSION["page_data"]["video"];
$weeklyViews = $_SESSION["page_data"]["weeklyViews"];
$latestVideos = $_SESSION["page_data"]["latestVideos"] ?? [];
$latestComments = $_SESSION["page_data"]["latestComments"] ?? [];
$followersCount = $_SESSION["page_data"]["followersCount"] ?? 0;

$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];
$ordered_views = orderningWeekDayAnalytics($weeklyViews);

// Date formatting
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
    <title>Analytics - Visão Geral</title>
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

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>

        <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

            <!-- General Dashboard Layout -->
            <!-- Header Section -->
            <div class="flex items-center gap-4 mb-8">
                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-purple-600">
                    <img src="<?= "/VHS/public/uploads/avatars/" . $_SESSION['user']['avatar_url'] ?? '/VHS/public/uploads/avatars/default.png' ?>" onerror="this.src='/VHS/public/uploads/avatars/default.png'" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">Boa tarde, <?= htmlspecialchars($_SESSION['user']['username']) ?></h1>
                    <div class="flex items-center gap-2 text-gray-400 text-sm mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                        <span><?= $date ?></span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                <!-- Left Column (Stats + Chart + Videos) -->
                <div class="xl:col-span-2 space-y-8">

                    <!-- Stats Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Seguidores -->
                        <div class="bg-[#121214] border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-purple-500/30 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs text-gray-400 font-medium">Seguidores</span>
                                <span class="text-[10px] text-green-400 bg-green-400/10 px-1.5 py-0.5 rounded flex items-center gap-0.5">
                                    +125% <svg class="w-2 h-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-white"><?= number_format($followersCount, 0, ',', '.') ?></h3>
                        </div>

                        <!-- Visualizações -->
                        <div class="bg-[#121214] border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-purple-500/30 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs text-gray-400 font-medium">Visualizações</span>
                                <span class="text-[10px] text-green-400 bg-green-400/10 px-1.5 py-0.5 rounded flex items-center gap-0.5">
                                    +125% <svg class="w-2 h-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-white"><?= number_format($video['views'], 0, ',', '.') ?></h3>
                        </div>

                        <!-- M. Visualizações -->
                        <div class="bg-[#121214] border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-purple-500/30 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs text-gray-400 font-medium">M. Visualizações</span>
                                <span class="text-[10px] text-green-400 bg-green-400/10 px-1.5 py-0.5 rounded flex items-center gap-0.5">
                                    +125% <svg class="w-2 h-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-white"><?= $video['avg_views'] ?></h3>
                        </div>

                        <!-- M. Avaliações -->
                        <div class="bg-[#121214] border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-purple-500/30 transition-all">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs text-gray-400 font-medium">M. Avaliações</span>
                                <span class="text-[10px] text-green-400 bg-green-400/10 px-1.5 py-0.5 rounded flex items-center gap-0.5">
                                    +125% <svg class="w-2 h-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-white"><?= $video['avg_stars'] ?></h3>
                        </div>
                    </div>

                    <!-- Main Chart -->
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-200">Seguidores</h3>
                            <select class="bg-transparent text-sm text-gray-400 border-none outline-none cursor-pointer hover:text-white">
                                <option>Semana</option>
                                <option>Mês</option>
                            </select>
                        </div>
                        <?= renderChartComponent($ordered_views, $categoriesLine, 'Semana', 'Seguidores', 'area') ?>
                    </div>

                    <!-- Latest Videos -->
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">
                        <h3 class="text-lg font-semibold text-gray-200 mb-6">Últimos vídeos</h3>
                        <div class="space-y-4">
                            <?php foreach ($latestVideos as $vid): ?>
                                <div class="flex items-center justify-between group hover:bg-white/5 rounded-lg p-2 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="w-40 h-24 rounded-lg overflow-hidden relative bg-gray-800">
                                            <img src="<?= htmlspecialchars($vid['thumbnail_url'] ?? '') ?>" class="w-full h-full object-cover" alt="<?= htmlspecialchars($vid['title'] ?? '') ?>">
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-white line-clamp-1"><?= htmlspecialchars($vid['title'] ?? 'Sem título') ?></h4>
                                            <div class="flex items-center gap-2 text-xs text-gray-400 mt-1">
                                                <span><?= formatViews($vid['views'] ?? 0) ?> visualizações</span>
                                                <span>•</span>
                                                <span><?= time_elapsed_string($vid['created_at'] ?? 'now') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <a href="/VHS/studio/content/video/edit?id=<?= $vid['id'] ?>" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg" title="Editar">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <a href="/VHS/studio/content/video/comment?id=<?= $vid['id'] ?>" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg" title="Ver Comentários">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </a>
                                        <a href="/VHS/studio/content/video/analytic?id=<?= $vid['id'] ?>" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg" title="Ver Analytics">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

                <!-- Right Column (Latest Comments) -->
                <div class="xl:col-span-1">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl h-full">
                        <h3 class="text-lg font-semibold text-gray-200 mb-6">Últimos comentários</h3>
                        <div class="space-y-6">
                            <?php foreach ($latestComments as $comment): ?>
                                <div class="flex gap-3">
                                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                        <img src="/VHS/public/uploads/avatars/<?= htmlspecialchars($comment['avatar_url']) ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-sm font-medium text-white"><?= htmlspecialchars($comment['name']) ?></span>
                                            <span class="text-xs text-gray-500"><?= time_elapsed_string($comment['created_at']) ?></span>
                                        </div>
                                        <p class="text-xs text-gray-400 leading-relaxed line-clamp-2">
                                            <?= htmlspecialchars($comment['content']) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>
</body>

</html>