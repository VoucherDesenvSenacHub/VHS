<?php
require "../../components/Perfil_Analytics/Perfil_Analytics.php";
require "../../components/utils/userActivityCardsComponent.php";
require "../../components/barra_admin/barra_admin.php";
require "../../components/header/headerComponent.php";
require "../../components/charts/chartComponent.php";
require "./components/chartsCategoryComponent/chartsCategoryComponent.php";
require "./components/cardActivityHistoryComponent/cardActivityHistoryComponent.php";
require "../../components/utils/comentaryDashboard/cardComment.component.php";

use function src\views\components\utils\comentaryDashboard\cardComment;
use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\Utils\UserActivityCardsComponent;
use function Src\Views\Components\Perfil_Analytics\renderPostComponent;
use function Src\Views\Components\Charts\renderChartComponent;
use function src\views\components\chartsCategoryComponent;
use function Src\Views\Components\cardActivityHistoryComponent;

$seriesDataLine = [10, 15, 25, 20, 18, 12, 15];
$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];

$seriesDataDonut = [3320, 260, 285, 105];
$labelsDonut = ['Tecnologia', 'Moda', 'Estatística', 'Saúde'];

$atividades = [
    [
        'data' => '10 de janeiro de 2025',
        'time' => '08:00',
        'usuario1' => 'João',
        'description' => 'alterou o status de',
        'usuario2' => 'Maria',
        'causa' => 'atraso'
    ],
    [
        'data' => '10 de janeiro de 2025',
        'time' => '11:23',
        'usuario1' => 'João',
        'description' => 'alterou o status de',
        'usuario2' => 'Maria',
        'causa' => 'atraso'
    ],
    [
        'data' => '11 de janeiro de 2025',
        'time' => '19:05',
        'usuario1' => 'João',
        'description' => 'alterou o status de',
        'usuario2' => 'Maria',
        'causa' => 'atraso'
    ],
    [
        'data' => '11 de janeiro de 2025',
        'time' => '19:05',
        'usuario1' => 'João',
        'description' => 'alterou o status de',
        'usuario2' => 'Maria',
        'causa' => 'atraso'
    ],
    [
        'data' => '11 de janeiro de 2025',
        'time' => '19:05',
        'usuario1' => 'João',
        'description' => 'alterou o status de',
        'usuario2' => 'Maria',
        'causa' => 'atraso'
    ],
    [
        'data' => '19 de julho de 2025',
        'time' => '19:05',
        'usuario1' => 'João',
        'description' => 'alterou o status de',
        'usuario2' => 'Maria',
        'causa' => 'atraso'
    ],
    [
        'data' => '13 de julho de 2025',
        'time' => '19:05',
        'usuario1' => 'João',
        'description' => 'alterou o status de',
        'usuario2' => 'Maria',
        'causa' => 'atraso'
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white font-[Poppins]">
    <?= HeaderComponent() ?>
    <div class="flex">
        <div class="min-w-[220px] position-fixed">
            <?= Barra_Admin() ?>
        </div>
        <div class="flex-1 px-4 py-6">
            <!-- Componente de perfil -->
            <?= renderPostComponent("") ?>

            <div class="flex items-start justify-between flex-row mt-4 gap-6">

                <div class="grid grid-col-2 items-center gap-6 max-w-[115vh] w-full">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 ">
                        <?= UserActivityCardsComponent("Usuários", 11000, '/VHS/public/icons/users.svg') ?>
                        <?= UserActivityCardsComponent("Qtd. Vídeos", 90, '/VHS/public/icons/video.svg') ?>
                        <?= UserActivityCardsComponent("Parceiros", 2, '/VHS/public/icons/handshake.svg') ?>
                        <?= UserActivityCardsComponent("Canais", 12, '/VHS/public/icons/Radioo.svg') ?>
                    </div>
                    <div class="">
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>

                    <div class="flex flex-col bg-[#1a1a1a] rounded-xl shadow-md min-h-[310px] gap-4 p-7">
                        <h1 class=" text-xl mb-2">Últimas denúncias</h1>
                        <?=
                        cardComment(photoPerfil: "https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg", title: "nome", time: "5 dias", description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit."),
                        cardComment(photoPerfil: "https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg", title: "nome", time: "5 dias", description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit."),
                        cardComment(photoPerfil: "https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg", title: "nome", time: "5 dias", description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit.")
                        ?>
                    </div>
                </div>
                <div class="grid grid-row-1 gap-6 mx-auto">
                    <div>
                        <?= chartsCategoryComponent($seriesDataDonut, $labelsDonut, 'Categorias', 'Tecnologia') ?>
                    </div>
                    <div class="w-max bg-[#1a1a1a] rounded-xl shadow-md">
                        <?= cardActivityHistoryComponent($atividades) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>