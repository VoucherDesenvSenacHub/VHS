<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/featuredCard/featuredCardComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\viewCards;
use function Views\Components\FeaturedCard\FeaturedCardComponent;
use function Src\Views\Components\Utils\ButtonComponent;

$categoryName = $_SESSION["page_data"]["category"] ?? null;
$videos = $_SESSION["page_data"]["videos"] ?? [];
$error = $_SESSION["page_data"]["error"] ?? null;


$FeaturedVideo = [];
if (!empty($videos)) {
    $FeaturedVideo = $videos[0];
    foreach ($videos as $video) {
        if (($video['views'] ?? 0) > ($FeaturedVideo['views'] ?? 0)) {
            $FeaturedVideo = $video;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - <?= htmlspecialchars($categoryName ?? 'Categorias') ?></title>
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
        <div class="hidden md:block h-full z-40">
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 p-6 w-full max-w-[1920px] mx-auto">

            <?php if ($error || !$categoryName): ?>
                <div class="flex flex-col items-center justify-center h-[60vh] text-center space-y-6 animate-fade-in">
                    <div class="w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white"><?= htmlspecialchars($error ?? "Categoria não encontrada") ?></h1>
                    <p class="text-gray-400 max-w-md">Parece que esta categoria não existe ou foi removida. Tente buscar por outra coisa.</p>
                    <a href="/VHS/home" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full font-medium transition-all transform hover:scale-105">
                        Voltar para o Início
                    </a>
                </div>
            <?php else: ?>

                <!-- Category Header -->
                <div class="mb-10 relative overflow-hidden rounded-3xl bg-gradient-to-r from-purple-900/40 to-blue-900/20 border border-white/5 p-8 md:p-12">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-purple-600/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl"></div>

                    <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="px-3 py-1 bg-purple-500/20 text-purple-300 text-xs font-bold uppercase tracking-wider rounded-full border border-purple-500/20">Categoria</span>
                            </div>
                            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-2">
                                <?= htmlspecialchars($categoryName) ?>
                            </h1>
                            <p class="text-gray-400 text-lg">Explorar os melhores vídeos em <?= htmlspecialchars(strtolower($categoryName)) ?></p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="text-right hidden md:block">
                                <p class="text-2xl font-bold text-white"><?= count($videos) ?></p>
                                <p class="text-sm text-gray-400">Vídeos encontrados</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Video (if any) -->
                <?php if (!empty($videos)): ?>
                    <section class="mb-16">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-1 h-6 bg-purple-500 rounded-full"></div>
                            <h2 class="text-2xl font-bold text-white">Destaque</h2>
                        </div>
                        <div class="transform hover:scale-[1.01] transition-transform duration-300">
                            <?= FeaturedCardComponent($FeaturedVideo, true) ?>
                        </div>
                    </section>
                <?php endif; ?>


                <section>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2">
                            <div class="w-1 h-6 bg-blue-500 rounded-full"></div>
                            <h2 class="text-2xl font-bold text-white">Todos os Vídeos</h2>
                        </div>
                    </div>

                    <?php if (empty($videos)): ?>
                        <div class="flex flex-col items-center justify-center py-20 bg-white/5 rounded-3xl border border-white/5 border-dashed">
                            <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Nenhum vídeo encontrado</h3>
                            <p class="text-gray-400 text-center max-w-sm">
                                Não há vídeos nesta categoria no momento. Volte mais tarde ou explore outras categorias.
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
                            <?php
                            $gridVideos = array_filter($videos, function ($v) use ($FeaturedVideo) {
                                return $v['id'] !== ($FeaturedVideo['id'] ?? null);
                            });

                            if (empty($gridVideos) && count($videos) > 1) {
                                echo viewCards(array_slice($videos, 1), 'videos');
                            } elseif (!empty($gridVideos)) {
                                echo viewCards($gridVideos, 'videos');
                            } else {
                                echo "<p class='col-span-full text-gray-500 text-center py-10'>Mais vídeos em breve...</p>";
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </section>

            <?php endif; ?>
        </main>
    </div>
</body>

</html>