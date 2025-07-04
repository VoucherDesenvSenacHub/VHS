<?php
require "../components/utils/Title_and_buttons.php";
require "../components/header/headerComponent.php";
require "../components/sidebar/barra_lateral.php";
require "../components/CardFastComponent/cardFast.php";

use function src\views\components\sidebar\SidebarComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\utils\Title_and_buttons;
use function src\Views\Components\CardFast;


$botoes = [
    ['texto' => 'Vídeos', 'link' => './VideosPage.php'],
    ['texto' => 'Fast', 'link' => './FastPage.php'],
    ['texto' => 'Eventos', 'link' => './EventosPage.php'],
    ['texto' => 'Canais', 'link' => './CanaisPage.php']
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast</title>
    <link rel="icon" href="../public/img/logo.svg">
    <!-- Incluindo o Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?=HeaderComponent() ?>
    </div>
    <div class="flex flex-col md:flex-row w-full">

        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>
        <main class="-mt-14">


            <div class="ml-8 px-4 sm:px-6 py-8 !mx-auto max-w-[95rem]">
                <?= Title_and_buttons("Resultados para o 'Next.js'", "lorem ipsum dolor sit amet, consectetur adipiscing elit. in elementum felis sit amet eros malesuada volutpat.", $botoes) ?>
                <div class="flex flex-wrap gap-12">
                    <div class="flex flex-wrap gap-12">
                        <?php
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                        echo CardFast([
                                'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                                'titulo' => 'espero vocês lá',
                                'likes' => '50K',
                                'views' => '540K'
                                ]);       
                    ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>