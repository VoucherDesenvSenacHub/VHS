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

<body>
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div>
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 px-4 sm:px-6 py-4 mx-auto">
            <div class="max-w-[1500px] mx-auto">
                <div class="flex gap-2 w-full overflow-x-auto pb-2 mb-6 scrollbar-hide">
                    <a href="/VHS/home/search?q=<?= urlencode($query) ?>&filter=video" class="<?= $filter === 'video' ? 'bg-purple-600' : 'bg-white/10 hover:bg-white/20' ?> px-4 py-2 rounded-lg transition-colors whitespace-nowrap">Vídeos</a>
                    <a href="/VHS/home/search?q=<?= urlencode($query) ?>&filter=fast" class="<?= $filter === 'fast' ? 'bg-purple-600' : 'bg-white/10 hover:bg-white/20' ?> px-4 py-2 rounded-lg transition-colors whitespace-nowrap">Fast</a>
                    <a href="/VHS/home/search?q=<?= urlencode($query) ?>&filter=event" class="<?= $filter === 'event' ? 'bg-purple-600' : 'bg-white/10 hover:bg-white/20' ?> px-4 py-2 rounded-lg transition-colors whitespace-nowrap">Eventos</a>
                    <a href="/VHS/home/search?q=<?= urlencode($query) ?>&filter=channels" class="<?= $filter === 'channels' ? 'bg-purple-600' : 'bg-white/10 hover:bg-white/20' ?> px-4 py-2 rounded-lg transition-colors whitespace-nowrap">Canais</a>
                </div>

                <?php if (empty($data)): ?>
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <img src="/VHS/public/icons/search-empty.svg" onerror="this.style.display='none'" class="w-32 h-32 mb-4 opacity-50">
                        <h3 class="text-xl font-semibold text-gray-300">Nenhum resultado encontrado</h3>
                        <p class="text-gray-500 mt-2">Tente pesquisar por outros termos ou verifique a ortografia.</p>
                    </div>
                <?php else: ?>
                    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 <?= $filter === 'channels' ? '!grid-cols-1' : '' ?>">
                        <?php
                        if ($filter === 'channels') {
                            foreach ($data as $channel) {
                                echo ChannelComponent($channel);
                            }
                        } else {
                            echo viewCards($data, $filter . "s");
                        }
                        ?>
                    </section>

                    <div class="mt-8 mb-8">
                        <?= paginate($data, $existsNextPage) ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>

</html>