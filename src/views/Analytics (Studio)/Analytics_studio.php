<?php
require "../components/header/headerComponent.php";
require "../components/studioSideMenu/studioSideMenuComponent.php";
require "../components/utils/Title_and_buttons.php";
require "../components/utils/userActivityCardsComponent.php";
require "../components/charts/chartComponent.php";

use function src\views\components\Charts\renderChartComponent;
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
    <title>Analytics - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="flex-1 px-4 py-6">
            <?= Title_and_buttons("Estatisticas do Vídeo", "loren", $botoes) ?>
            <div class="flex flex-row gap-8 mt-4">

                <div class="grid grid-col-2 gap-8">

                    <div class="flex flex-row gap-4 mb-2">

                        <?= UserActivityCardsComponent("Usuários", 60700) ?>


                        <?= UserActivityCardsComponent("Qtd. Vídeos", 60700) ?>


                        <?= UserActivityCardsComponent("Parceiros", 60700) ?>


                        <?= UserActivityCardsComponent("Canais", 60700) ?>
                    </div>
                    <div class="">
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>
                    <div class="">
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>
                </div>

                <div class="ml-24  w-[570px] rounded-xl">
                    <img src="https://pbs.twimg.com/media/Df_Uj8QX4AMwcFM.jpg:large" alt=""
                        class="rounded-xl h-[300px] w-full object-cover">

                    <div class="mt-4 ml-2">
                        <h3 class="text-xl font-semibold text-white">Entrei na Hotel abandonado e encontramos isso 😨😧😱😰😱 FT Renato Garcia
                        </h3>
                        <p class="text-sm text-gray-400 mt-1"># 🚀💻🛠️</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>