<?php
require_once __DIR__ . "/../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../components/utils/userActivityCardsComponent.php";
require_once __DIR__ . "/../../../../components/charts/chartComponent.php";
require_once __DIR__ . "/../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../../application/utils/orderningWeekDayAnalytics.php";

use function src\views\components\Charts\renderChartComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function src\views\components\utils\UserActivityCardsComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\Header\HeaderComponent;
use function Src\Application\Utils\orderningWeekDayAnalytics;


// TODO: REFATORAR ESSE GRAFICO FEITO PELO GROK

$video = $_SESSION["page_data"]["video"];
$weeklyViews = $_SESSION["page_data"]["weeklyViews"];
$weeklyAvaliations = $_SESSION["page_data"]["weeklyAvaliations"];

$seriesDataLine = [0, 15, 25, 20, 18, 12, 15];
$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];

$botoes = [
    ['texto' => 'Edição', 'link' => './VideosPage.php'],
    ['texto' => 'Comentarios', 'link' => './FeastPage.php'],
    ['texto' => 'Analytics', 'link' => './EventosPage.php']
];

$id = $video['id'];

$ordered_views = orderningWeekDayAnalytics($weeklyViews);
$ordered_avaliations = orderningWeekDayAnalytics($weeklyAvaliations);

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
</head>

<body
    class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= StudioSideMenuComponent() ?>
        </div>
        <div class="flex-1 px-4 py-6 max-w-auto md:max-w-[1500px] m-auto px-6">
            <h1 class="text-title font-semibold mb-2">Analytics do vídeo</h1>
            <p class="text-sm text-gray-300 mb-4">Analise os dados do seu vídeo, como visualizações e avaliações semanais</p>
            <div class="flex gap-4 w-full md:w-96 my-4">
                <div class="flex gap-3 w-[22rem] md:w-[28rem]">
                        <?php
                        echo ButtonComponent(text: "Edição", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/video/edit?id=$id");
                        echo ButtonComponent(text: "Comentários", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/video/commentary?id=$id");
                        echo ButtonComponent(text: "Analytics", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/video/analytic?id=$id");
                        ?>
                </div>
            </div> 
            <div class="flex flex-col md:flex-row">

                <div class="flex flex-col gap-8">

                    <div class="flex flex-col md:flex-row gap-4 mb-2">

                        <?= UserActivityCardsComponent("Visualizações", $video['views']) ?>


                        <?= UserActivityCardsComponent("Comentarios", $video['comments']) ?>


                        <?= UserActivityCardsComponent("M Visualizações", (int)$video['avg_views']) ?>


                        <?= UserActivityCardsComponent("Compartilhados", $video['shared']) ?>
                    </div>
                    <div class="">
                        <?= renderChartComponent($ordered_views, $categoriesLine, 'Semana', 'Visualização') ?>
                    </div>
                    <div class="">
                        <?= renderChartComponent($ordered_avaliations, $categoriesLine, 'Semana', 'Avaliação', 'bar') ?>
                    </div>
                </div>

                <div class="mt-4 md:mt-0 ml-0 md:ml-24 w-full md:w-[570px] rounded-xl">
                    <img src="<?= htmlspecialchars($video["thumbnail_url"]) ?>" alt=""
                        class="rounded-xl h-[300px] w-full object-cover">

                    <div class="mt-4 ml-2">
                        <h3 class="text-xl font-semibold text-white"><?= $video["title"] ?></h3>
                        <p class="text-sm text-gray-400 mt-1"><?= $video['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>