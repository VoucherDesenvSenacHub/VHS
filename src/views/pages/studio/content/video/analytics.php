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

$id = $video['id'] ?? "";

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

                <?= UserActivityCardsComponent("Visualizações", $video['views'] ?? 0) ?>


                <?= UserActivityCardsComponent("Comentarios", $video['comments'] ?? 0) ?>


                <?= UserActivityCardsComponent("M Visualizações", $video['avg_views'] ?? 0) ?>


                <?= UserActivityCardsComponent("Compartilhados", $video['shared'] ?? 0) ?>
            </div>
            <div class="">
                <?= renderChartComponent($ordered_views, $categoriesLine, 'Semana', 'Visualização') ?>
            </div>
            <div class="">
                <?= renderChartComponent($ordered_avaliations, $categoriesLine, 'Semana', 'Avaliação', 'bar') ?>
            </div>
        </div>

        <div class="mt-4 md:mt-0 ml-0 md:ml-24 w-full md:w-[570px] rounded-xl">
            <img src="<?= htmlspecialchars($video["thumbnail_url"] ?? "") ?>" alt=""
                class="rounded-xl h-[300px] w-full object-cover">

            <div class="mt-4 ml-2">
                <h3 class="text-xl font-semibold text-white"><?= $video["title"] ?? "" ?></h3>
                <p class="text-sm text-gray-400 mt-1"><?= $video['description'] ?? "" ?></p>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>

</html>