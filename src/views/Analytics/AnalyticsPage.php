<?php
require "../components/Perfil_Analytics/Perfil_Analytics.php";
require "../components/utils/userActivityCardsComponent.php";
require "../components/barra_admin/barra_admin.php";
require "../components/header/headerComponent.php";
require "../components/charts/chartComponent.php";
require "../components/charts/donutChartComponent.php";
require "../components/Notification_List/notificationListComponent.php";


use function src\views\components\header\Barra_Admin;
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
    'Freelancer bonus a usar até Circa, motivo: incompreensível.',
    'Freelancer bonus a usar até Circa, motivo: incompreensível.',
    'Freelancer bonus a usar até Circa, motivo: incompreensível.',
    'Freelancer bonus a usar até Circa, motivo: incompreensível.',
    'Freelancer bonus a usar até Circa, motivo: incompreensível.'
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
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <!-- Header -->
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-row mt-4">
        <div>
            <?= Barra_Admin() ?>
        </div>

        <div class="flex-1 p-4">
            <?php
            renderPostComponent("");
            ?>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div><?= UserActivityCardsComponent("Usuários", 11000) ?></div>
                <div><?= UserActivityCardsComponent("QTD.Vídeos", 90) ?></div>
                <div><?= UserActivityCardsComponent("Parceiros", 2) ?></div>
                <div><?= UserActivityCardsComponent("Canais", 12) ?></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <?php
                echo renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários');
                ?>
                <?php
                echo renderDonutChartComponent($seriesDataDonut, $labelsDonut, 'Categorias', 'Tecnologia');
                ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <?php
                    echo renderNotificationListComponent($notificationItems);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>