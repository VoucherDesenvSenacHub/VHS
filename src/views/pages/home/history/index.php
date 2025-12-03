<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";
require_once __DIR__ . "/../../../components/cards/index.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\viewCards;

$history = $_SESSION["page_data"]["history"] ?? [];
$pagination = $_SESSION["page_data"]["pagination"] ?? ['current_page' => 1, 'total_pages' => 1];
$activeTab = $_SESSION["page_data"]["active_tab"] ?? 'all';
$currentPage = $pagination['current_page'];
$totalPages = $pagination['total_pages'];

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime('now', new DateTimeZone('UTC'));
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $weeks = floor($diff->d / 7);
    $days = $diff->d - ($weeks * 7);

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
        $val = 0;
        if ($k === 'w') {
            $val = $weeks;
        } elseif ($k === 'd') {
            $val = $days;
        } elseif (property_exists($diff, $k)) {
            $val = $diff->$k;
        }

        if ($val) {
            $v = $val . ' ' . $v . ($val > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' atrás' : 'agora mesmo';
}

$historyVideos = array_map(function ($video) {

    $watchedAt = time_elapsed_string($video["watched_at"]);

    return $video + [
        'type_card' => $video['type'] === 'fast' ? 'fasts' : 'videos',
        "created_at" => $video["watched_at"],
        "duration" => $video["duration"],
        "views" => "Assistido " . $watchedAt
    ];
}, $history);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Histórico</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <style>
        .glass-header {
            background: rgba(32, 0, 44, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#100018] to-black text-white min-h-screen flex flex-col overflow-x-hidden">

    <?= HeaderComponent() ?>

    <div class="flex flex-1">
        <div>
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 p-6 w-full max-w-[1920px] mx-auto">

            <div class="mb-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight mb-2">Histórico de Exibição</h1>
                        <p class="text-gray-400">Veja o que você assistiu recentemente.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 border-b border-white/10 pb-1">
                    <a href="?tab=all" class="px-4 py-2 text-sm font-medium transition-colors relative <?= $activeTab === 'all' ? 'text-white' : 'text-gray-400 hover:text-gray-200' ?>">
                        Todos
                        <?php if ($activeTab === 'all'): ?>
                            <div class="absolute bottom-[-5px] left-0 w-full h-1 bg-purple-500 rounded-t-full"></div>
                        <?php endif; ?>
                    </a>
                    <a href="?tab=video" class="px-4 py-2 text-sm font-medium transition-colors relative <?= $activeTab === 'video' ? 'text-white' : 'text-gray-400 hover:text-gray-200' ?>">
                        Vídeos
                        <?php if ($activeTab === 'video'): ?>
                            <div class="absolute bottom-[-5px] left-0 w-full h-1 bg-purple-500 rounded-t-full"></div>
                        <?php endif; ?>
                    </a>
                    <a href="?tab=fast" class="px-4 py-2 text-sm font-medium transition-colors relative <?= $activeTab === 'fast' ? 'text-white' : 'text-gray-400 hover:text-gray-200' ?>">
                        Fasts
                        <?php if ($activeTab === 'fast'): ?>
                            <div class="absolute bottom-[-5px] left-0 w-full h-1 bg-purple-500 rounded-t-full"></div>
                        <?php endif; ?>
                    </a>
                </div>
            </div>

            <?php if (empty($historyVideos)): ?>
                <div class="flex flex-col items-center justify-center py-20 bg-[#121214] rounded-3xl border border-white/5 border-dashed">
                    <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Histórico vazio</h3>
                    <p class="text-gray-400 text-center max-w-sm">
                        Nenhum item encontrado nesta categoria.
                    </p>
                    <a href="/VHS/home" class="mt-6 px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full font-medium transition-all transform hover:scale-105">
                        Explorar
                    </a>
                </div>
            <?php else: ?>

                <?php if ($activeTab === 'all'): ?>
                    <?php
                    $videosOnly = array_filter($historyVideos, fn($v) => $v['type_card'] === 'videos');
                    $fastsOnly = array_filter($historyVideos, fn($v) => $v['type_card'] === 'fasts');
                    ?>

                    <?php if (!empty($videosOnly)): ?>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-1 h-6 bg-purple-500 rounded-full"></div>
                            <h2 class="text-xl font-bold text-white">Vídeos</h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 mb-12">
                            <?= viewCards($videosOnly, 'videos'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($fastsOnly)): ?>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-1 h-6 bg-pink-500 rounded-full"></div>
                            <h2 class="text-xl font-bold text-white">Shorts</h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 mb-12">
                            <?= viewCards($fastsOnly, 'fasts'); ?>
                        </div>
                    <?php endif; ?>

                <?php elseif ($activeTab === 'video'): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 mb-12">
                        <?= viewCards($historyVideos, 'videos'); ?>
                    </div>
                <?php elseif ($activeTab === 'fast'): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 mb-12">
                        <?= viewCards($historyVideos, 'fasts'); ?>
                    </div>
                <?php endif; ?>


                <?php if ($totalPages > 1): ?>
                    <div class="flex justify-center items-center gap-2 mt-8">
                        <?php if ($currentPage > 1): ?>
                            <a href="?tab=<?= $activeTab ?>&page=<?= $currentPage - 1 ?>" class="px-4 py-2 bg-white/5 hover:bg-white/10 rounded-lg text-white transition-colors">
                                Anterior
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?tab=<?= $activeTab ?>&page=<?= $i ?>" class="w-10 h-10 flex items-center justify-center rounded-lg transition-colors <?= $i === $currentPage ? 'bg-purple-600 text-white' : 'bg-white/5 hover:bg-white/10 text-gray-400' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                            <a href="?tab=<?= $activeTab ?>&page=<?= $currentPage + 1 ?>" class="px-4 py-2 bg-white/5 hover:bg-white/10 rounded-lg text-white transition-colors">
                                Próxima
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        </main>
    </div>
</body>

</html>