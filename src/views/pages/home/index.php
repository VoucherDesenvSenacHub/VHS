<?php

// Requires dos componentes necessários
require_once __DIR__ . "/../../components/header/headerComponent.php";
require_once __DIR__ . "/../../components/sidebar/SidebarComponent.php";
require_once __DIR__ . "/../../components/cards/index.php";
require_once __DIR__ . "/../../components/featuredCard/featuredCardComponent.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\renderCards;
use function Views\Components\FeaturedCard\FeaturedCardComponent;

echo "<style>
    * {
        color: white;
    }
</style>";

// print_r($_SESSION["page_data"]["popular_videos"]);
// print_r($_SESSION["page_data"]["emphasised_videos"]);
// print_r($_SESSION["page_data"]["categories"]);


// Mock de dados para a página home
$featuredVideos = $_SESSION["page_data"]["featured_videos"] ?? [];
$mostPopularVideos = array_map(function ($video) {
    return $video + ['type_card' => 'video'];
}, $_SESSION["page_data"]["popular_videos"] ?? []);
$categories = $_SESSION["page_data"]["categories"] ?? [];

// TODO: Refatorar renderCards

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
        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 px-4 sm:px-6 py-4 mx-auto">
            <div class="max-w-[1500px] mx-auto">
                
                <section class="mb-12">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="lg:col-span-1">
                            <?= FeaturedCardComponent($featuredVideos[0]) ?>
                        </div>
                        
                        <div class="lg:col-span-1">
                            <?= FeaturedCardComponent($featuredVideos[1]) ?>
                        </div>
                    </div>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl font-bold text-white mb-2"><span class="text-purple-400">#</span> Mais populares</h2>
                    <p class="text-gray-400 text-sm mb-6">Confira os vídeos mais populares da nossa plataforma VHS</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        <?= renderCards($mostPopularVideos, 'video'); ?>
                    </div>
                </section>

                <?php foreach ($categories as $category): ?>
                    <section class="mb-12">
                        <h2 class="text-2xl font-bold text-white mb-6"><span class="text-purple-400">#</span> <?= $category['name'] ?? "" ?></h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?= renderCards($category["videos"], 'video'); ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
</html>