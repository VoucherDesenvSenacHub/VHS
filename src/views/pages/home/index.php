<?php
require_once __DIR__ . "/../../components/header/headerComponent.php";
require_once __DIR__ . "/../../components/sidebar/index.php";
require_once __DIR__ . "/../../components/cards/index.php";
require_once __DIR__ . "/../../components/featuredCard/featuredCardComponent.php";
require_once __DIR__ . "/../../components/utils/sweetalert.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\viewCards;
use function Views\Components\FeaturedCard\FeaturedCardComponent;
use function Src\Application\Utils\showSweetAlert;

$errors = $_SESSION['redirect_data']['errors'] ?? null;
unset($_SESSION['redirect_data']);

$featuredVideos = $_SESSION["page_data"]["featured_videos"] ?? [];
$mostPopularVideos = array_map(function ($video) {
    return $video + ['type_card' => 'video'];
}, $_SESSION["page_data"]["popular_videos"] ?? []);
$categories = $_SESSION["page_data"]["categories"] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Home</title>
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

        /* Custom scrollbar for horizontal scrolling if needed */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
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

            <!-- Featured Section -->
            <?php if (!empty($featuredVideos)): ?>
                <section class="mb-12 relative">
                    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-1 h-6 bg-purple-500 rounded-full"></div>
                        <h2 class="text-2xl font-bold text-white">Destaques</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <?php if (isset($featuredVideos[0])): ?>
                            <div class="lg:col-span-1 transform hover:scale-[1.01] transition-transform duration-300">
                                <?= FeaturedCardComponent($featuredVideos[0]) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($featuredVideos[1])): ?>
                            <div class="lg:col-span-1 transform hover:scale-[1.01] transition-transform duration-300">
                                <?= FeaturedCardComponent($featuredVideos[1]) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Most Popular Section -->
            <section class="mb-16">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-6 bg-blue-500 rounded-full"></div>
                        <h2 class="text-2xl font-bold text-white">Mais Populares</h2>
                    </div>
                    <a href="#" class="text-sm text-purple-400 hover:text-purple-300 font-medium transition-colors">Ver todos</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
                    <?= viewCards($mostPopularVideos, 'videos'); ?>
                </div>
            </section>

            <!-- Categories Sections -->
            <?php foreach ($categories as $category): ?>
                <?php if (!empty($category["videos"])): ?>
                    <section class="mb-12 border-t border-white/5 pt-8">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-2">
                                <div class="w-1 h-6 bg-pink-500 rounded-full"></div>
                                <h2 class="text-2xl font-bold text-white"><?= htmlspecialchars($category['name']) ?></h2>
                            </div>
                            <a href="/VHS/home/categories?category=<?= urlencode($category['name']) ?>" class="text-sm text-purple-400 hover:text-purple-300 font-medium transition-colors">
                                Ver mais de <?= htmlspecialchars($category['name']) ?>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
                            <?= viewCards(array_slice($category["videos"], 0, 5), 'videos'); ?>
                        </div>
                    </section>
                <?php endif; ?>
            <?php endforeach; ?>

        </main>
    </div>

    <?php echo isset($errors) ? showSweetAlert('Sem Permissão!', $errors, 'error') : ''; ?>
</body>

</html>