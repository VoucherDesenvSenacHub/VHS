<?php
require "../components/header/headerComponent.php";
require "../components/studioSideMenu/studioSideMenuComponent.php";
require "../components/utils/userActivityCardsComponent.php";
require "../components/charts/chartComponent.php";
require_once "../components/utils/buttonComponent.php";

use function src\views\Components\Utils\ButtonComponent;
use function src\views\components\Charts\renderChartComponent;
use function src\views\components\utils\UserActivityCardsComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\Header\HeaderComponent;

$seriesDataLine = [10, 15, 25, 20, 18, 12, 15];
$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];
$botoes = [
    [
        'texto' => 'Edição',
        'link' => './VideosPage.php'
    ],
    [
        'texto' => 'Comentarios',
        'link' => './FeastPage.php'
    ],
    [
        'texto' => 'Analytics',
        'link' => './EventosPage.php'
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] via-black to-[#20002c] min-h-screen text-white font-[Poppins]">
    <div class="fixed w-full">
        <?= HeaderComponent() ?>
    </div>
    <div class="flex w-full">
        <div class="hidden md:block mt-20">
            <?= StudioSideMenuComponent() ?>
        </div>
        <div class="flex-1 sm: md:flex-col sm:p-6 justify-center py-6 mt-20 mr-6">
            <div class="flex flex-col">
                <div class="flex flex-col gap-2 mb-5">
                    <h1 class="text-2xl font-semibold">Estatísticas do Vídeo</h1>
                    <p class="text-sm text-gray-300">Acompanhe o desempenho do seu conteúdo com métricas detalhadas e insights em tempo real!</p>
                </div>
                <div class="flex mb-5 gap-5">
                    <?= ButtonComponent("Edição", "studio", "", 10.675, 2.5, "", "../edicao-de-video/index.php") ?>
                    <?= ButtonComponent("Comentários", "studio", "", 10.675, 2.5, "", "../studio/Comentários.php") ?>
                    <?= ButtonComponent("Analytics", "studio", "", 10.675, 2.5, "", "", true) ?>
                </div>
            </div>
            <div class="flex sm:justify-center  flex-wrap md:flex-auto justify-between gap-4 mt-4">
                <div class="grid grid-col-2 items-center gap-6 sm:w-96  min-w-[118vh]">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                        <?= UserActivityCardsComponent("Visualizações", 60700, '/VHS/public/icons/eyePurple.svg') ?>
                        <?= UserActivityCardsComponent("Comentários", 60700, '/VHS/public/icons/message-circle.svg') ?>
                        <?= UserActivityCardsComponent("Curtidas", 60700, '/VHS/public/icons/thumbs-up.svg') ?>
                        <?= UserActivityCardsComponent("Compartilhamento", 60700, '/VHS/public/icons/share-2.svg') ?>
                    </div>
                    <div>
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>
                    <div>
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>
                </div>
                <div class="bg-[#1B1B1B] rounded-xl w-full sm:m-0 mx-auto max-w-lg max-h-[32rem]">
                    <div class="w-full h-64 rounded-t-lg overflow-hidden video-image-container">
                        <img src="https://pbs.twimg.com/media/Df_Uj8QX4AMwcFM.jpg:large" alt="" class="rounded-t-lg ease-in w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div>
                            <span class="text-white text-lg font-semibold">Tudo sobre o Next.js 15, nova arquitetura de pasta!</span>
                            <div class="flex items-center gap-2 text-sm text-slate-400">
                                <span class="text-gray-400">Publicado há 2 dias</span>
                                <span class="text-gray-400"> • </span>
                                <span class="text-gray-400">8:12 min</span>
                            </div>
                        </div>
                        <div class="pt-0">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-2xl">🚀</span>
                                <span class="text-2xl">⚡</span>
                                <span class="text-2xl">🎯</span>
                                <span class="text-2xl">🔥</span>
                            </div>
                            <span class="text-slate-300 text-base leading-relaxed">
                                Descubra todas as novidades do Next.js 15 e como a nova arquitetura de pastas pode revolucionar seus
                                projetos React.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>