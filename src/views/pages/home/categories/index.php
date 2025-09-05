<?php

require __DIR__ . "/../../../components/header/headerComponent.php";
require __DIR__ . "/../../../components/sidebar/SidebarComponent.php";
require __DIR__ . "/../../../components/cards/index.php";
require __DIR__ . "/../../../components/featuredCard/featuredCardComponent.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\renderCards;
use function Views\Components\FeaturedCard\FeaturedCardComponent;

$videos = $_SESSION["page_data"]["videos"] ?? [];
$category = $_SESSION["page_data"]["category"] ?? "Não encontrado!";
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
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 px-4 sm:px-6 py-4 mx-auto">
            <div class="max-w-[1500px] mx-auto">
                <h2 class="text-2xl font-bold text-white mb-2"><span class="text-purple-400">#</span> <?= $category ?></h2>
                <p class="text-gray-400 text-sm mb-6">Confira os vídeos mais populares da nossa plataforma VHS da categoria, <?= $category ?></p>
                
                
                <section class="mb-12">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="lg:col-span-1">
                            <?= !empty($videos) || !$category ? FeaturedCardComponent($videos[0], true) : "" ?>
                        </div>
                </section>
                <section class="mb-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?= renderCards(array_slice($videos, 1), 'video'); ?>
                    </div>
                </section>
                <section>

                </section>
            </div>
        </main>
    </div>
</body>
</html>