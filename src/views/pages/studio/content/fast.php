<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/fastCard/index.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";

use function Src\Application\Utils\paginate;
use function Src\Views\Components\FastCard\FastCardComponent;
use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\InputComponent;

$fasts = $_SESSION["page_data"]["fasts"] ?? [];
$nextPage = $_SESSION["page_data"]["next_page"] ?? 0;
$search = $_SESSION["page_data"]["search"] ?? '';
$sort = $_SESSION["page_data"]["sort"] ?? 'desc';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Shorts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
    <?= HeaderComponent(); ?>

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>

        <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

            <div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">Conteúdo do canal</h1>
                    <p class="text-gray-400 mt-1">Gerencie seus vídeos curtos</p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 mb-8 items-center justify-between">
                <!-- Custom Tabs -->
                <div class="flex p-1 bg-[#121214] border border-white/5 rounded-xl w-full lg:w-auto">
                    <a href="/VHS/studio/content/video" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                        Vídeos
                    </a>
                    <a href="/VHS/studio/content/fast" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium bg-purple-600 text-white shadow-lg transition-all">
                        Shorts
                    </a>
                </div>

                <!-- Premium Search Input -->
                <form action="" method="get" class="flex flex-col md:flex-row gap-4 w-full lg:w-auto items-center">
                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">

                    <div class="relative group w-full md:w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-purple-500 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="<?= htmlspecialchars($search) ?>"
                            placeholder="Pesquisar shorts..."
                            class="block w-full pl-10 pr-10 py-2.5 bg-[#121214] border border-white/10 rounded-xl text-gray-300 placeholder-gray-500 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 sm:text-sm transition-all">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="showFilterMenu()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                        </div>

                        <div id="filter" class="absolute right-0 top-full mt-2 z-20 hidden w-48 bg-[#1E1E20] border border-white/10 rounded-xl shadow-2xl overflow-hidden">
                            <div class="p-2 space-y-1">
                                <a href="?search=<?= urlencode($search) ?>&sort=desc" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition-colors group <?= $sort === 'desc' ? 'bg-purple-500/10' : '' ?>">
                                    <span class="text-sm font-medium <?= $sort === 'desc' ? 'text-purple-400' : 'text-gray-300' ?>">Mais recentes</span>
                                </a>
                                <a href="?search=<?= urlencode($search) ?>&sort=asc" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 transition-colors group <?= $sort === 'asc' ? 'bg-purple-500/10' : '' ?>">
                                    <span class="text-sm font-medium <?= $sort === 'asc' ? 'text-purple-400' : 'text-gray-300' ?>">Mais antigos</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php if (empty($fasts)): ?>
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <h3 class="text-xl font-bold text-white mb-2">Nenhum short encontrado</h3>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php
                    foreach ($fasts as $fast) {
                        echo FastCardComponent([
                            'id' => $fast['id'],
                            'thumbnail_url' => $fast['thumbnail_url'],
                            'title' => $fast['title'],
                            'likes' => $fast['likes'] ?? '0',
                            'views' => $fast['views'] ?? '0'
                        ], true);
                    }
                    ?>
                </div>

                <div class="mt-8">
                    <?= paginate($fasts, $nextPage) ?>
                </div>
            <?php endif; ?>

        </main>
    </div>

    <!-- Script to handle card options menu (same as video cards) -->
    <script src="/VHS/src/views/components/cards/script.js" defer></script>

    <script defer>
        const input = document.querySelector("input[name='search']");
        let timeout = null;

        input.addEventListener("input", () => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                input.form.submit();
            }, 1000);
        });

        function showFilterMenu() {
            const filter = document.getElementById('filter');
            filter.classList.toggle('hidden');
        }
    </script>
</body>

<?php
unset($_SESSION["redirect_data"]);

if (!isset($_GET['search'])) {
    unset($_SESSION['page_data']['search']);
}
?>

</html>