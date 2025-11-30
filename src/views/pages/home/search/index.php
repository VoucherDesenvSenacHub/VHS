<?php

$data = $_SESSION["page_data"]["data"] ?? [];
$filter = $_SESSION["page_data"]["filter"] ?? 'video';
$query = $_SESSION["page_data"]["query"] ?? '';
$existsNextPage = $_SESSION["page_data"]["existsNextPage"] ?? 0;

require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/channel/channelComponent.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";

use function Src\Views\Components\Channel\channelComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Cards\viewCards;
use function Src\Application\Utils\paginate;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Pesquisa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#100018] to-black text-white min-h-screen flex flex-col overflow-x-hidden">
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block h-full z-40">
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 px-4 sm:px-6 py-4 mx-auto w-full max-w-[1920px]">
            <div class="mb-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white tracking-tight mb-2">Resultados da Pesquisa</h1>
                        <p class="text-gray-400">Exibindo resultados para "<?= htmlspecialchars($query) ?>"</p>
                    </div>

                    <!-- Search Input -->
                    <form action="/VHS/home/search" method="GET" class="w-full md:w-auto">
                        <input type="hidden" name="filter" value="<?= htmlspecialchars($filter) ?>">
                        <div class="relative group">
                            <input
                                type="text"
                                name="q"
                                value="<?= htmlspecialchars($query) ?>"
                                placeholder="Pesquisar novamente..."
                                class="w-full md:w-80 bg-white/5 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 pl-12 pr-4 focus:outline-none focus:border-purple-500 focus:bg-white/10 transition-all duration-300">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 group-focus-within:text-purple-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tabs -->
                <div class="flex items-center gap-4 border-b border-white/10 pb-1">
                    <a href="/VHS/home/search?q=<?= urlencode($query) ?>&filter=video" class="px-4 py-2 text-sm font-medium transition-colors relative whitespace-nowrap <?= $filter === 'video' ? 'text-white' : 'text-gray-400 hover:text-gray-200' ?>">
                        Vídeos
                        <?php if ($filter === 'video'): ?>
                            <div class="absolute bottom-[-5px] left-0 w-full h-1 bg-purple-500 rounded-t-full"></div>
                        <?php endif; ?>
                    </a>
                    <a href="/VHS/home/search?q=<?= urlencode($query) ?>&filter=fast" class="px-4 py-2 text-sm font-medium transition-colors relative whitespace-nowrap <?= $filter === 'fast' ? 'text-white' : 'text-gray-400 hover:text-gray-200' ?>">
                        Shorts
                        <?php if ($filter === 'fast'): ?>
                            <div class="absolute bottom-[-5px] left-0 w-full h-1 bg-pink-500 rounded-t-full"></div>
                        <?php endif; ?>
                    </a>
                    <a href="/VHS/home/search?q=<?= urlencode($query) ?>&filter=channels" class="px-4 py-2 text-sm font-medium transition-colors relative whitespace-nowrap <?= $filter === 'channels' ? 'text-white' : 'text-gray-400 hover:text-gray-200' ?>">
                        Canais
                        <?php if ($filter === 'channels'): ?>
                            <div class="absolute bottom-[-5px] left-0 w-full h-1 bg-blue-500 rounded-t-full"></div>
                        <?php endif; ?>
                    </a>
                </div>
            </div>

            <?php if (empty($data)): ?>
                <div class="flex flex-col items-center justify-center py-20 bg-white/5 rounded-3xl border border-white/5 border-dashed">
                    <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Nenhum resultado encontrado</h3>
                    <p class="text-gray-400 text-center max-w-sm">
                        Não encontramos nada para "<?= htmlspecialchars($query) ?>". Tente outros termos.
                    </p>
                </div>
            <?php else: ?>
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 <?= $filter === 'channels' ? '!grid-cols-1 sm:!grid-cols-1 lg:!grid-cols-2 xl:!grid-cols-3' : '' ?>">
                    <?php
                    if ($filter === 'channels') {
                        foreach ($data as $channel) {
                            echo ChannelComponent($channel);
                        }
                    } else {
                        $renderType = $filter === 'fast' ? 'fasts' : 'videos';
                        echo viewCards($data, $renderType);
                    }
                    ?>
                </section>

                <div class="mt-8 mb-8 flex justify-center">
                    <?= paginate($data, $existsNextPage) ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>

</html>