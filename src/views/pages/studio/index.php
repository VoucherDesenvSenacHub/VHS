<?php
require "../../components/header/headerComponent.php";
require "../../components/studioSideMenu/studioSideMenuComponent.php";
require "../../components/utils/Title_and_buttons.php";
require "../../components/utils/userActivityCardsComponent.php";
require "../../components/charts/chartComponent.php";
require "../../components/utils/buttonComponent.php";
require "../../components/utils/comments/comentaryComponent.php";
require "../../components/cards/studioVideoComponent.php";

use function Src\Views\Components\Cards\StudioVideoComponent;
use function src\views\components\Charts\renderChartComponent;
use function Src\Views\Components\Utils\Comment;
use function src\views\components\utils\UserActivityCardsComponent;
use function src\views\components\Utils\Title_and_buttons;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\Header\HeaderComponent;

$seriesDataLine = [10, 15, 25, 20, 18, 12, 15];
$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];

$botoes = [
    ['texto' => 'Edição', 'link' => './VideosPage.php'],
    ['texto' => 'Comentarios', 'link' => './FeastPage.php'],
    ['texto' => 'Analytics', 'link' => './EventosPage.php']
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
</head>

<body>
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= StudioSideMenuComponent() ?>
        </div>

        <main class="max-w-[1500px] mx-auto">
            <section class="flex gap-4">
                <img src="https://cdn.pipocamoderna.com.br/wp-content/uploads/2025/05/Virginia-Fonseca.jpg" alt="" class="size-12 rounded-full">
                <div>
                    <h2 class="text-2xl font-semibold text-white">
                        Boa tarde, Virginia Fonseca!
                    </h2>
                    <p class="text-secondary">
                        Quinta, 15 de agosto!
                    </p>
                </div>
            </section>


            <div class="grid grid-cols-2">            
                <div>
                    <section class="mt-4 flex gap-4">
                        <?= UserActivityCardsComponent("Seguidores", 6700) ?>
                        <?= UserActivityCardsComponent("Visualizações", 67000) ?>
                        <?= UserActivityCardsComponent("M. Visualizações", 32000) ?>
                        <?= UserActivityCardsComponent("M. Avaliações", 4.5) ?>
                    </section>

                    <section class="mt-4 bg-gray600 p-6 rounded-lg border border-white/20 relative">
                        <h2 class="text-white font-semibold absolute z-10">Visualizações por semana</h2>
                        <div id="studio-chart">
                        </div>
                        <script src="/VHS/src/views/pages/studio/chart.js"></script>
                        <script>
                            setChart([10, 15, 25, 20, 18, 12, 15], ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'], "Semana", "Visualizações", "studio-chart")
                        </script>
                    </section>

                    <section class="p-6 bg-gray600 mt-4 rounded-lg border border-white/20 flex flex-col gap-2 ">
                        <h2 class="text-white font-semibold absolute z-10 text-xl">
                            Ultimos vídeos
                        </h2>
                        <div class="mt-8 pb-4 pt-2 flex flex-col gap-4">
                            <?= StudioVideoComponent("1", "Virgina fonseca no discord, top demais!", "https://i.imgur.com/OZXgam6.png", 445) ?>
                            <?= StudioVideoComponent("1", "Virgina fonseca no discord, top demais!", "https://i.imgur.com/OZXgam6.png", 445) ?>
                            <?= StudioVideoComponent("1", "Virgina fonseca no discord, top demais!", "https://i.imgur.com/OZXgam6.png", 445) ?>
                            <?= StudioVideoComponent("1", "Virgina fonseca no discord, top demais!", "https://i.imgur.com/OZXgam6.png", 445) ?>
                        </div>
                    </section>
                </div>
                
                <section class="p-6 bg-gray600 ml-4 mt-4 rounded-lg border border-white/20 flex flex-col gap-2 max-w-[26rem]">
                    <h2 class="text-white font-semibold absolute z-10 text-xl">
                        Útimos comentários
                    </h2>
                    <div class="mt-8">
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                        <?= Comment("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg") ?>
                    </div>
                </section>
            </div>
        </main>
</body>

</html>