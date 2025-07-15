<?php
require __DIR__ . '../components/cardLatestVideosComponent/cardLatestVideosComponent.php';
require __DIR__ . '../components/cardLastCommentComponent/cardLastCommentComponent.php';
require "../../components/header/headerComponent.php";
require "../../components/studioSideMenu/studioSideMenuComponent.php";
require "../../components/charts/chartComponent.php";
require "../../components/utils/userActivityCardsComponent.php";
require "../../components/utils/Title_and_buttons.php";
require "../../components/Perfil_Analytics/Perfil_Analytics.php";

use function src\views\components\Header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\Charts\renderChartComponent;
use function src\views\components\utils\UserActivityCardsComponent;
use function Src\Views\Components\Perfil_Analytics\renderPostComponent;

$videos = [
    [
        'title' => 'Vídeo 1',
        'amountPreview' => '100',
        'url' => 'https://exemplo.com/video1',
        'image' => 'https://github.com/shadcn.png'
    ],
    [
        'title' => 'Vídeo 2',
        'amountPreview' => '200',
        'url' => 'https://exemplo.com/video2',
        'image' => 'https://github.com/shadcn.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/shadcn.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/shadcn.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/shadcn.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/shadcn.png'
    ],
];

$comentarios = [
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/shadcn.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/shadcn.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/shadcn.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/shadcn.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/shadcn.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/shadcn.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
];

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
    ],
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
    <script src="../../../styles/tailwindglobal.js"></script>
    <script src="../../../styles/global.css"></script>
</head>

<body class="w-full h-full m-0 bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat text-white">
    <div class="fixed w-full">
        <?= HeaderComponent() ?>
    </div>
    <div class="flex w-full">
        <div class="hidden md:block mt-20">
            <?= StudioSideMenuComponent() ?>
        </div>
        <div class="flex-1 md:flex-col justify-center py-6 mt-20">
            <?= renderPostComponent("") ?>
            <div class="flex justify-between flex-row gap-6 mt-4">
                <div class="grid grid-col-2 items-center gap-6 min-w-[115vh]">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 ">
                        <?= UserActivityCardsComponent("Inscritos", 60700, '/VHS/public/icons/users.svg') ?>
                        <?= UserActivityCardsComponent("Seus Vídeos", 60700, '/VHS/public/icons/video.svg') ?>
                        <?= UserActivityCardsComponent("Parceiros", 60700, '/VHS/public/icons/handshake.svg') ?>
                        <?= UserActivityCardsComponent("Canais", 60700, '/VHS/public/icons/Radioo.svg') ?>
                    </div>
                    <div>
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>
                    <div>
                        <?=
                        CardLatestVideosComponent($videos);
                        ?>
                    </div>
                </div>
                <div class="w-1/2 flex justify-center rounded-xl">
                    <?=
                    CardLatestCommentComponent($comentarios);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>