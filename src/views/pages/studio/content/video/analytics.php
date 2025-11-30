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

// Date formatting for header (Custom implementation to avoid setlocale/strftime issues)
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

// Helper function for time ago
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'ano',
        'm' => 'mês',
        'w' => 'semana',
        'd' => 'dia',
        'h' => 'hora',
        'i' => 'minuto',
        's' => 'segundo',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
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

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>

        <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">
            <?php if ($isGeneral): ?>
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
                                <h3 class="text-2xl font-bold text-white"><?= number_format($followersCount, 0, ',', '.') ?>k</h3>
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
                                <h3 class="text-2xl font-bold text-white"><?= number_format($video['views'], 0, ',', '.') ?>k</h3>
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
                                <h3 class="text-2xl font-bold text-white"><?= $video['avg_views'] ?>k</h3>
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
                                <h3 class="text-2xl font-bold text-white"><?= $video['avg_stars'] ?>k</h3>
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
                                            <a href="/VHS/studio/content/video/commentary?id=<?= $vid['id'] ?>" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg" title="Ver Comentários">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                </svg>
                                            </a>
                                            <a href="/VHS/studio/content/video/analytics?id=<?= $vid['id'] ?>" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg" title="Ver Analytics">
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

            <?php else: ?>
                <!-- Video Specific Analytics Layout (Refactored) -->
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
            <?php endif; ?>

        </main>
    </div>
</body>

</html>