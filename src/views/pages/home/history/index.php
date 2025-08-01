<?php

require "../../../components/header/headerComponent.php";
require "../../../components/sidebar/SidebarComponent.php";
require "../../../components/cards/index.php";
require "../../../components/featuredCard/featuredCardComponent.php";
require_once "../../../components/utils/inputComponent.php";
require_once "../../../components/utils/buttonComponent.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\renderCards;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Views\Components\FeaturedCard\FeaturedCardComponent;

$type = $_GET["type"] ?? "video";

// Mock de dados para a página home
$featuredVieo = [
    "url" => "https://youtube.com/watch?v=destaque",
    "duration" => "7 min",
    "title" => "Configurando Docker Compose, Postgres, com Testes de Carga - Parte Final da Rinha de Backend",
    "username" => "Fábio Akita",
    "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
    "views" => "1.1M",
    "created_at" => "há 2 dias",
];

$videoHTMX = [
    "url" => "https://youtube.com/watch?v=htmx",
    "type_card" => "video",
    "description" => "RocketSeat",
    "duration" => "16 min", 
    "title" => "HTMX: HTML com Super Poderes | RocketSeat - Discover",
    "username" => "Diego da RocketSeat",
    "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
    "views" => "108 views",
    "created_at" => "há 2 dias",
    "maked_for" => "Online",
    "likes" => 1500,
    "comments" => 125
];

$mostPopularVideos = [
    [
        "url" => "https://youtube.com/watch?v=nextjs1",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "5.5k views",
        "created_at" => "há 7 dias",
        "maked_for" => "Online",
        "likes" => 890,
        "comments" => 67
    ],
    [
        "url" => "https://youtube.com/watch?v=nextjs2", 
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano", 
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "5.5k views",
        "created_at" => "há 7 dias",
        "maked_for" => "Online",
        "likes" => 890,
        "comments" => 67
    ],
    [
        "url" => "https://youtube.com/watch?v=nextjs3",
        "type_card" => "video", 
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "5.5k views", 
        "created_at" => "há 7 dias",
        "maked_for" => "Online",
        "likes" => 890,
        "comments" => 67
    ],
    [
        "url" => "https://youtube.com/watch?v=startups",
        "type_card" => "video",
        "description" => "Rafael Germano", 
        "duration" => "7 min",
        "title" => "10 Mitos sobre tech startups - Parte 1",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "10k views",
        "created_at" => "há 5 dias",
        "maked_for" => "Online", 
        "likes" => 1200,
        "comments" => 89
    ]
];

$techVideos = [
    [
        "url" => "https://youtube.com/watch?v=neovim",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min", 
        "title" => "Como configurar o NEOVIM para ser uma",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "8.5k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=startups2",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "10 Mitos sobre tech startups - Parte 1",
        "username" => "Rafael Germano", 
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "8.5k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=nextjs4",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png", 
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "8.5k views",
        "created_at" => "há 2 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=python2",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Aprenda PYTHON em 1 hora",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g", 
        "views" => "8.5k views",
        "created_at" => "há 2 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ]
];

$healthVideos = [
    [
        "url" => "https://youtube.com/watch?v=saude1",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "8.5k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=primeiros-socorros",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Noções básicas em primeiros socorros",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "8.5k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=hospital",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Vingadores visitam hospital",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "8.5k views", 
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=sus",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Sistema Único de Saúde - SUS",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g",
        "views" => "35k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ]
];

$styleVideos = [
    [
        "url" => "https://youtube.com/watch?v=moda1",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g9",
        "views" => "45k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=moda2",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g0",
        "views" => "55k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=moda3",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g1",
        "views" => "65k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ],
    [
        "url" => "https://youtube.com/watch?v=moda4",
        "type_card" => "video",
        "description" => "Rafael Germano",
        "duration" => "7 min",
        "title" => "Tudo sobre o Next.js 15, nova arquitetura de pasta",
        "username" => "Rafael Germano",
        "thumbnail_url" => "https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png",
        "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g2",
        "views" => "75k views",
        "created_at" => "há 3 semanas atrás",
        "maked_for" => "Online",
        "likes" => 750,
        "comments" => 45
    ]
];

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
    <script src="/VHS/src/views/pages/home/history/script.js" defer></script>
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
                    <h2 class="text-2xl font-bold text-white mb-2"><span class="text-purple-400">#</span> Histórico</h2>
                    <p class="text-gray-400 text-sm mb-6">
                        Confira os vídeos que você já assistiu!
                    </p>
                    <div class="flex gap-2 max-w-96 mb-4">
                        <?= ButtonComponent("Vídeos", "studio", width:8, height:2.5) ?>
                        <?= ButtonComponent("Fast", "studio", width:8, height:2.5) ?>
                        <?= ButtonComponent("Eventos", "studio", width:8, height:2.5) ?>
                    </div>
                    <div class="relative">
                        <ul class="flex flex-col gap-3 bg-gray600 p-2 pr-4 filter-menu absolute z-10 top-16 hidden rounded-xl border border-white/20">
                            <li
                                class=" text-white font-medium flex text-base gap-2 items-center ml-1 cursor-pointer"
                            >
                                <img src="/VHS/public/icons/clock.svg" class="w-5 h-5" />
                                <p>Mais recentes</p>
                            </li>
                            <li
                                class=" text-white font-medium flex text-base gap-2 items-center ml-1 cursor-pointer"
                            >
                                <img src="/VHS/public/icons/clock2.svg" class="w-5" />
                                <p>Mais antigos</p>
                            </li>
                        </ul>
                        <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()") ?>
                    </div>
                    <br>
                    <div>
                        <h3 class="text-secondary text-xl font-medium mb-4">
                            # 08/07/2025 - Hoje
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            <?= renderCards($mostPopularVideos, 'video'); ?>
                            <?= renderCards($mostPopularVideos, 'video'); ?>
                            <?= renderCards($mostPopularVideos, 'video'); ?>
                            <?= renderCards($mostPopularVideos, 'video'); ?>
                            <?= renderCards($mostPopularVideos, 'video'); ?>
                        </div>
                    </div>
                </section>
        </main>
    </div>
</body>
</html>