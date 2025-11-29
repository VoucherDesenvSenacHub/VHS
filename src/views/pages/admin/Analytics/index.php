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
use function Src\Application\Utils\orderningWeekDayAnalytics;

$allUsers = $_SESSION['page_data']['all_users'];
$allVideos = $_SESSION['page_data']['all_videos'];
$allChannels = $_SESSION['page_data']['all_channels'];
$lastsReportsComments = $_SESSION['page_data']['lasts_reports_comments'];
$categoriesTotal = $_SESSION['page_data']['categories_total'];

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
</head>

<body class="text-white">
    <?= HeaderComponent() ?>
    <div class="flex">
            <?= Barra_Admin() ?>
        <div class="flex-1 p-6 w-full">
            <?= renderPostComponent($user['avatar_url'], $user['name']) ?>
            <div class="flex items-start justify-between flex-col md:flex-row mt-4 gap-6">
                <div class="grid grid-col-2 items-center gap-6 max-w-[115vh] w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 ">
                        <?= UserActivityCardsComponent("Usuários", $allUsers, '/VHS/public/icons/users.svg') ?>
                        <?= UserActivityCardsComponent("Qtd. Vídeos", $allVideos, '/VHS/public/icons/video.svg') ?>
                        <?= UserActivityCardsComponent("Canais", $allChannels, '/VHS/public/icons/Radioo.svg') ?>
                    </div>
                    <div>
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>
                    <div>
                        <?= cardLatestReportComponent($lastsReportsComments); ?>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 mx-auto w-full max-w-full lg:max-w-[52vh]">
                    <div class="w-full">
                        <?= chartsCategoryComponent($labelsDonut, $seriesDataDonut, 'Categorias', $seriesDataDonut[0]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>