<?php

    require_once __DIR__ . "/../components/header/headerComponent.php";
    require_once __DIR__ . "/../components/sidebar/index.php";
    require_once __DIR__ . "/../components/featuredCard/featuredEventComponent.php";
    require_once __DIR__ . "/../components/cards/index.php";

    use function Src\Views\Components\Header\HeaderComponent;
    use function Src\Views\Components\Sidebar\CreateSidebar;
    use function Src\Views\Components\Cards\renderCards;
    use function Views\Components\FeaturedCard\FeaturedEventCard;

    $category = isset($_GET['category']) ? $_GET['category'] : 'tecnologia';

    $categories = [
        'tecnologia' => 'Tecnologia',
        'saude' => 'Saúde',
        'moda' => 'Moda',
        'estetica' => 'Estética',
    ];

    $featuredVieo = [
        'image_url' => 'https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png',
        'title' => 'Usando IA para processamento de geoinformação em Python, com GIS AXIS',
        'instructor' => 'Ministrado por Paulo Silveira',
        'event_type' => 'Pago | Presencial',
        'date' => '09-08 18:15',
    ];

    $techVideos = [
        [
            "url" => "https://youtube.com/watch?v=nextjs4",
            "type_card" => "event",
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
            "type_card" => "event",
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
        ],
        [
            "url" => "https://youtube.com/watch?v=nextjs4",
            "type_card" => "event",
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
            "type_card" => "event",
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
        ],
        [
            "url" => "https://youtube.com/watch?v=python2",
            "type_card" => "event",
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

?>

<!-- H T M L -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Home</title>

    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body class="w-full min-h-screen bg-background">
    <?= HeaderComponent(); ?>

    <div class="flex flex-col md:flex-row w-full">
        <?= CreateSidebar(); ?>

        <main class="flex-1 px-4 sm:px-6 py-4 mx-auto">
            <div class="max-w-[1500px] mx-auto">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-2"><span class="text-purple-400">#</span> Eventos  🚀</h2>
                    <p class="text-gray-400 text-sm mb-6">Confira o evento que está acontecendo agora 🔥</p>
                </div>
                
                
                <section class="mb-12">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="lg:col-span-1">
                            <?= FeaturedEventCard($featuredVieo, true)  ?>
                        </div>
                </section>
                <section class="mb-12">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2"><span class="text-purple-400">#</span> Eventos que irão acontecer 🔥</h2>
                        <p class="text-gray-400 text-sm mb-6">Confira os vídeo mais populares da nossa plataforma VHS</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?= renderCards($techVideos, 'event'); ?>   
                        </div>
                    </section>
            </div>
        </main>
    </div>
</body>
</html>