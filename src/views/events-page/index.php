<?php

    require_once __DIR__ . "/../components/header/headerComponent.php";
    use function Src\Views\Components\Header\HeaderComponent;
    
    require_once __DIR__ . "/../components/sidebar/barra_lateral.php";
    use function Src\Views\Components\Sidebar\SidebarComponent;

    require_once __DIR__ . "/../components/cards/index.php";
    use function Src\Views\Components\Cards\renderCards;

    require_once __DIR__ . "/../components/featuredCard/featuredCardComponent.php";
    use function Views\Components\FeaturedCard\FeaturedCardComponent;

?>
 
<!DOCTYPE html>
<html lang="pt-BR">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
 
<body class="bg-background text-white">
    <?= HeaderComponent(); ?>
    
    <div class="flex">
        <?= SidebarComponent(); ?>

        <div class="flex-1 p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold mb-2"># Eventos  🚀</h1>
                <h3 class="text-lg text-[#C4C4C4]">Confira o evento que está acontecendo agora 🔥</h3>
                    <?php
                        $featuredVideo = isset($featuredVideo) && is_array($featuredVideo) ? $featuredVideo : [
                            'url'=> 'https://youtube.com/watch?v=destaque',
                            'duration'=> '7 min',      
                            'title' => 'Nenhum evento em destaque no momento',
                            'username' => 'Fábio Akita',
                            'thumbnail_url' => 'https://framerusercontent.com/images/TO1bOWR2ihsAvIgtbf5Y9taYWZs.png',
                            'avatar_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS2EntOCdE0yEaIfacfxiU1ZyRi8RSeT-eu_HDeQSq6J_veZZesXpwlcxkWxM2NKMpWRb4CRyw9WdUGOQV7ZqK8g',
                            'views' => '1.1M',
                            'created_at' => 'há 2 dias'
                        ];
                        echo FeaturedCardComponent($featuredVideo, true);
                    ?>
            </div>

            <div>
                <h1 class="text-2xl font-bold mb-2"># Eventos que irão acontecer 🔥</h1>
                <h3 class="text-lg mb-4 text-[#C4C4C4]">Confira os vídeo mais populares da nossa plataforma VHS</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5 gap-3 flex-wrap pb-20">
                    <?php
                        renderCards($cards, 'event');
                        renderCards($cards, 'event');
                        renderCards($cards, 'event');
                        renderCards($cards, 'event');

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>