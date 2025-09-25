<?php

$videos = $_SESSION["page_data"]["videos"] ?? [];

$fast = $_SESSION["page_data"]["fast"] ?? [];

require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";
require_once __DIR__ . "/../../../components/featuredCard/featuredCardComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/channel/channelComponent.php";
// require_once __DIR__ . "/../../../components/CardFastComponent/cardFast.php";
require_once __DIR__ . "/../../../../controllers/SearchVideoController.php";

use function Src\Views\Components\Cards\renderCards;
use function Src\Views\Components\Channel\channelComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function src\Views\Components\CardFast;
use src\Application\Controllers\SearchVideoController;


$term = isset($_GET['term']) ? htmlspecialchars($_GET['term']) : '';
$filter = isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : 'videos';
$query = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '';


$SearchVideoController = new SearchVideoController();
$SearchVideoController->index();


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

];

$techVideos = [];

$techVideos = array_map(function ($item) {
    return [
        "url" => $item["url"],
        "type_card" => strtolower($item["type"]),
        "description" => $item["description"], 
        "duration" => $item["duration"],
        "title" => $item["title"],
        "username" => 'Ronan',
        "thumbnail_url" => $item["thumbnail_url"],
        "avatar_url" => 'sdjssajkldsj',
        "views" => $item["views"],
        "created_at" => $item["created_at"],
        "maked_for" => 'Onlien', 
        "likes" => 45,
        "comments" => 45
    ];
}, $videos);

$techFasts = [];

$techFasts = array_map(function ($item) {
    return [
        "url" => $item["url"],
        "type_card" => strtolower($item["type"]),
        "description" => $item["description"], 
        "duration" => $item["duration"],
        "title" => $item["title"],
        "username" => 'Ronan',
        "thumbnail_url" => $item["thumbnail_url"],
        "avatar_url" => 'sdjssajkldsj',
        "views" => $item["views"],
        "created_at" => $item["created_at"],
        "maked_for" => 'Onlien', 
        "likes" => 45,
        "comments" => 45
    ];
}, $fast);



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
                <div class="flex gap-2 w-[900px] mb-6">
                    <?= ButtonComponent("Vídeos", "studio", "",10.675, 2.5, 1, "?term=$term&filter=videos&q=$query") ?>
                    <?= ButtonComponent("Fast", "studio", "",10.675, 2.5, 1, "?term=$term&filter=fast&q=$query") ?>
                    <?= ButtonComponent("Eventos", "studio", "",10.675, 2.5, 1, "?term=$term&filter=events&q=$query") ?>
                    <?= ButtonComponent("Canais", "studio", "",10.675, 2.5, 1, "?term=$term&filter=channels&q=$query") ?>
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
                } else if ($filter === "fast") {
                    echo renderCards($techFasts, 'fast');       
                } else {
                    echo renderCards($techVideos, 'video');
                }
                ?>
            </section>
        </main>

    </div>
</body>
</html>