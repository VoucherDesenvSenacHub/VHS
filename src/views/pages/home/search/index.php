<?php

require "../../../components/header/headerComponent.php";
require "../../../components/sidebar/barra_lateral.php";
require "../../../components/featuredCard/featuredCardComponent.php";
require "../../../components/utils/buttonComponent.php";
require "../../../components/cards/index.php";
require "../../../components/channel/channelComponent.php";

use function Src\Views\Components\Cards\createChannelCard;
use function Src\Views\Components\Cards\renderCards;
use function Src\Views\Components\Channel\channelComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Utils\ButtonComponent;


$term = isset($_GET['term']) ? htmlspecialchars($_GET['term']) : '';
$filter = isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : 'videos';


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

$mostPopularVideos = [
    [
        "url" => "https://youtube.com/watch?v=nextjs1",
        "type_card" => "event",
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
        "type_card" => "event",
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
        "type_card" => "event", 
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
        "type_card" => "event",
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

$render = [
    "videos" => [
        "title" => "Vídeos",
        "data" => $techVideos,
        "type_card" => "video"
    ],
    "events" => [
        "title" => "Eventos",
        "data" => $mostPopularVideos,
        "type_card" => "event"
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

        <main class="flex-1 px-4 sm:px-6 py-4 max-w-[1500px] mx-auto">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2"><span class="text-purple-400">#</span> Resultados para "<?= $term ?>"</h2>
                <p class="text-gray-400 text-sm mb-6">Confira os resultado para "<?= $term ?>" com a categoria desejada</p>
                <div class="flex flex-wrap gap-4 mb-6">
                    <?= ButtonComponent("Vídeos", "studio", "","170px", "40px", 1, "?term=$term&filter=videos") ?>
                    <?= ButtonComponent("Fast", "studio", "","170px", "40px", 1, "?term=$term&filter=fast") ?>
                    <?= ButtonComponent("Eventos", "studio", "","170px", "40px", 1, "?term=$term&filter=events") ?>
                    <?= ButtonComponent("Canais", "studio", "","170px", "40px", 1, "?term=$term&filter=channels") ?>
                </div>
            </div>
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 <?= $filter === 'channels' ? '!grid-cols-1' : ''?>">
                <?php 

                if($filter === "channels") {
                    echo ChannelComponent([
                    "name" => "Fabio akita",
                    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgrByKyCU1H5DtDK2lYIPKafulJ4TzK4SNpg&s",
                    "category" => "#Tecnologia",
                    "followers" => 5000
                    ]);
                    echo ChannelComponent([
                    "name" => "Fabio akita",
                    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgrByKyCU1H5DtDK2lYIPKafulJ4TzK4SNpg&s",
                    "category" => "#Tecnologia",
                    "followers" => 5000
                    ]);
                    echo ChannelComponent([
                    "name" => "Fabio akita",
                    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgrByKyCU1H5DtDK2lYIPKafulJ4TzK4SNpg&s",
                    "category" => "#Tecnologia",
                    "followers" => 5000
                    ]);
                    echo ChannelComponent([
                    "name" => "Fabio akita",
                    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgrByKyCU1H5DtDK2lYIPKafulJ4TzK4SNpg&s",
                    "category" => "#Tecnologia",
                    "followers" => 5000
                    ]);
                    echo ChannelComponent([
                    "name" => "Fabio akita",
                    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgrByKyCU1H5DtDK2lYIPKafulJ4TzK4SNpg&s",
                    "category" => "#Tecnologia",
                    "followers" => 5000
                    ]);
                    echo ChannelComponent([
                    "name" => "Fabio akita",
                    "avatar_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgrByKyCU1H5DtDK2lYIPKafulJ4TzK4SNpg&s",
                    "category" => "#Tecnologia",
                    "followers" => 5000
                    ]);
                } else {
                    echo renderCards($render[$filter]["data"], $render[$filter]["type_card"]);
                }
                ?>
            </section>
        </main>

    </div>
</body>
</html>