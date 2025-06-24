<?php
require "../components/Perfil_Analytics/Perfil_Analytics.php";
require "../components/utils/userActivityCardsComponent.php";
require "../components/barra_admin/barra_admin.php";
require "../components/header/headerComponent.php";
require "../components/charts/chartComponent.php"; // Adicione o novo componente

use function src\views\components\header\Barra_Admin;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\Utils\UserActivityCardsComponent;
use function Src\Views\Components\Perfil_Analytics\renderPostComponent;
use function Src\Views\Components\charts\renderChartComponent;

$seriesData = [10, 15, 25, 20, 18, 12, 15];
$categories = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
    <style>
        #chart {
            @apply max-w-full p-4;
        }
    </style>
</head>
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?= HeaderComponent() ?>
    </div>
    <div>
        <?= Barra_Admin() ?>
    </div>
    <?php
    // Exemplo de URL de imagem (substitua por uma URL válida)
    renderPostComponent("");
    ?>
    <div class="container mx-auto p-4">
        <?= UserActivityCardsComponent("views", 62375) ?>
    </div>
    <div class="container mx-auto p-4 rounded-2xl">
        <?= renderChartComponent($seriesData, $categories, 'Semana', 'Usuários'); ?>
    </div>
</body>
</html>