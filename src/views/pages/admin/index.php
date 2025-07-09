<?php
require "../../components/Perfil_Analytics/Perfil_Analytics.php";
require "../../components/utils/userActivityCardsComponent.php";
require "../../components/barra_admin/barra_admin.php";
require "../../components/header/headerComponent.php";
require "../../components/charts/chartComponent.php";
require "../../components/charts/donutChartComponent.php";
require "../../components/Notification_List/notificationListComponent.php";
require "../../components/utils/comentaryDashboard/cardComment.component.php";

use function src\views\components\utils\comentaryDashboard\cardComment;
use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\Utils\UserActivityCardsComponent;
use function Src\Views\Components\Perfil_Analytics\renderPostComponent;
use function Src\Views\Components\Charts\renderChartComponent;
use function Src\Views\Components\Charts\renderDonutChartComponent;
use function Src\Views\Components\renderNotificationListComponent;

$seriesDataLine = [10, 15, 25, 20, 18, 12, 15];
$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];

$seriesDataDonut = [3320, 260, 285, 105];
$labelsDonut = ['Tecnologia', 'Moda', 'Estatística', 'Saúde'];

$notificationItems = [
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Admin - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>    
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <!-- Header superior -->
    <?= HeaderComponent() ?>

    <div class="flex">
        <!-- Sidebar -->
        <div class="min-w-[220px] position-fixed">
            <?= Barra_Admin() ?>
        </div>

        <!-- Conteúdo principal -->
        <div class="flex-1 px-4 py-6 max-w-[1500px] mx-auto">
            <!-- Componente de perfil -->
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

            <div class="flex flex-row gap-8 mt-4">

                <div class="grid grid-col-2 gap-8">

                    <div class="flex flex-row gap-4 mb-2">

                        <?= UserActivityCardsComponent("Usuários", 11000) ?>


                        <?= UserActivityCardsComponent("Qtd. Vídeos", 90) ?>


                        <?= UserActivityCardsComponent("Parceiros", 2) ?>


                        <?= UserActivityCardsComponent("Canais", 12) ?>
                    </div>
                    <div class="">
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>

                    <div class="flex flex-col bg-[#1a1a1a] rounded-xl shadow-md min-h-[310px] gap-4 p-7 border border-white/20">
                        <h1 class=" text-xl font-semibold">Últimas denúncias</h1>
                        <?=
                        cardComment(photoPerfil: "https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg", title: "nome", time: "5 dias", description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit."),
                        cardComment(photoPerfil: "https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg", title: "nome", time: "5 dias", description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit."),
                        cardComment(photoPerfil: "https://png.pngtree.com/png-vector/20220617/ourmid/pngtree-dachshund-dog-animal-care-image-little-vector-png-image_37262910.jpg", title: "nome", time: "5 dias", description: "Lorem ipsum dolor sit, amet consectetur adipisicing elit.")
                        ?>
                    </div>
                </div>
                <!-- Gráfico Donut junto aos cards -->
                <div class="">
                    <div class="mb-4">
                        <?= renderDonutChartComponent($seriesDataDonut, $labelsDonut, 'Categorias', 'Tecnologia') ?>
                    </div>

                    
                    <div class="bg-[#1a1a1a] rounded-xl">
                        <?= renderNotificationListComponent($notificationItems) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>