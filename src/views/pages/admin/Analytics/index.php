<?php
require_once __DIR__ . "/../../../components/Perfil_Analytics/Perfil_Analytics.php";
require_once __DIR__ . "/../../../components/utils/userActivityCardsComponent.php";
require_once __DIR__ . "/../../../components/barra_admin/barra_admin.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/charts/chartComponent.php";
require_once __DIR__ . "/components/chartsCategoryComponent/chartsCategoryComponent.php";
require_once __DIR__ . "/components/cardActivityHistoryComponent/cardActivityHistoryComponent.php";
require_once __DIR__ . "/components/cardLatestReportComponent/cardLatestReportComponent.php";
require_once __DIR__ . '/../../../../application/utils/orderningWeekDayAnalytics.php';

use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\Utils\UserActivityCardsComponent;
use function Src\Views\Components\Perfil_Analytics\renderPostComponent;
use function Src\Views\Components\Charts\renderChartComponent;
use function src\views\components\chartsCategoryComponent;
use function Src\Views\Components\cardLatestReportComponent;
use function Src\Views\Components\cardActivityHistoryComponent;
use function Src\Application\Utils\orderningWeekDayAnalytics;

$allUsers = $_SESSION['page_data']['all_users'];
$allVideos = $_SESSION['page_data']['all_videos'];
$allChannels = $_SESSION['page_data']['all_channels'];
$allReports = $_SESSION['page_data']['all_reports'];
$lastsReportsComments = $_SESSION['page_data']['lasts_reports_comments'];
$categoriesTotal = $_SESSION['page_data']['categories_total'];
$activities = $_SESSION['page_data']['activities'] ?? [];

$seriesDataLine = orderningWeekDayAnalytics($_SESSION['page_data']['all_count_users_login_weekday']);
$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];

$seriesDataDonut = [];
$labelsDonut = [];

foreach ($categoriesTotal as $category) {
    array_push($seriesDataDonut, $category['name']);
    array_push($labelsDonut, $category['total']);
};

$user = $_SESSION["user"] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden font-[Poppins]">
    <?= HeaderComponent() ?>

    <div class="flex flex-col md:flex-row w-full">
        <div>
            <?= Barra_Admin() ?>
        </div>

        <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-8">
                <div class="flex items-center gap-4">
                    <?= renderPostComponent($user['avatar_url'], $user['name']) ?>
                </div>
            </div>

            <!-- Row 1: Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <?= UserActivityCardsComponent("Usuários", $allUsers, '/VHS/public/icons/users.svg') ?>
                <?= UserActivityCardsComponent("Qtd. Vídeos", $allVideos, '/VHS/public/icons/video.svg') ?>
                <?= UserActivityCardsComponent("Canais", $allChannels, '/VHS/public/icons/Radioo.svg') ?>
                <?= UserActivityCardsComponent("Denúncias", $allReports, '/VHS/public/icons/warning.svg') ?>
            </div>

            <!-- Row 2: Chart & Categories -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
                <!-- Chart (2/3) -->
                <div class="xl:col-span-2">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl h-full">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-white">Usuários</h3>
                            <span class="text-sm text-gray-400">Semana</span>
                        </div>
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>
                </div>

                <!-- Categories (1/3) -->
                <div class="xl:col-span-1">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl h-full">
                        <h3 class="text-lg font-semibold text-white mb-6">Categorias</h3>
                        <?= chartsCategoryComponent($labelsDonut, $seriesDataDonut, 'Categorias', $seriesDataDonut[0] ?? 'N/A') ?>
                    </div>
                </div>
            </div>

            <!-- Row 3: Reports & Actions -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Reports (2/3) -->
                <div class="xl:col-span-2">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl h-full">
                        <h3 class="text-lg font-semibold text-white mb-6">Últimas Denúncias</h3>
                        <?= cardLatestReportComponent($lastsReportsComments); ?>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>

</html>