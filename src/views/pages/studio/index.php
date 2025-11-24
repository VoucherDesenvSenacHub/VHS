<?php
require_once __DIR__ . '/../../components/Header/HeaderComponent.php';
require_once __DIR__ . "/../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../components/utils/Title_and_buttons.php";
require_once __DIR__ . "/../../components/utils/userActivityCardsComponent.php";
require_once __DIR__ . "/../../components/charts/chartComponent.php";
require_once __DIR__ . "/../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../components/utils/comments_studio/commentAnalyticsComponent.php";
require_once __DIR__ . "/../../components/cards/studioVideoComponent.php";
require_once __DIR__ . '/../../../application/utils/getCurrentDataTime.php';

use function Src\Views\Components\Cards\StudioVideoComponent;
use function src\views\components\Charts\renderChartComponent;
use function Src\Views\Components\Utils\CommentStudioAnalytics;
use function src\views\components\utils\UserActivityCardsComponent;
use function src\views\components\Utils\Title_and_buttons;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\Header\HeaderComponent;
use function Src\Application\Utils\getCurrentDataTime;

$current_user = $_SESSION['user'];
$followers = $_SESSION["page_data"]["count_followers"][0]['COUNT(id)'];
$views = $_SESSION["page_data"]["all_views"];
$avereng_views = (int)$_SESSION["page_data"]["average_views"] ?? 0;
$average_avaliations = (int)$_SESSION["page_data"]["average_avaliations"] ?? 0;
$last_comments = $_SESSION["page_data"]["last_comments"];
$last_videos = $_SESSION["page_data"]["last_videos"];
$views_weekly = $_SESSION["page_data"]["views_weekly"];

$botoes = [
    ['texto' => 'Edição', 'link' => './VideosPage.php'],
    ['texto' => 'Comentarios', 'link' => './FeastPage.php'],
    ['texto' => 'Analytics', 'link' => './EventosPage.php']
];

[$weekday, $timeDefault, $data] = getCurrentDataTime();
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
    <script src="/VHS/src/views/pages/studio/chart.js"></script>
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

        <main class="max-w-[1500px] mx-auto px-6 pt-[1.18rem]">
            <section class="flex gap-4">
                <img src='/VHS/public/uploads/avatars/<?= $current_user["avatar_url"]?>' alt="" class="size-12 rounded-full" onerror="this.src='/VHS/public/uploads/avatars/default.png'">
                <div>
                    <h2 class="text-2xl font-semibold text-white">
                        <?= $timeDefault ?>, <?= $current_user['username'] ?>!
                    </h2>
                    <p class="text-secondary">
                        <?= $weekday ?>, <?= $data ?>
                    </p>
                </div>
            </section>


            <div class="grid grid-cols-2">            
                <div>
                    <section class="mt-4 flex gap-4">
                        <?= UserActivityCardsComponent("Seguidores", $followers) ?>
                        <?= UserActivityCardsComponent("Visualizações", $views) ?>
                        <?= UserActivityCardsComponent("M. Visualizações", $avereng_views) ?>
                        <?= UserActivityCardsComponent("M. Avaliações", $average_avaliations) ?>
                    </section>

                    <section class="mt-4 bg-gray600 p-6 rounded-lg border border-white/20 relative">
                        <h2 class="text-white font-semibold absolute top-4 left-6 z-10">Visualizações por semana</h2>
                        <div id="studio-chart" class="h-80 mt-10"></div>
                        <script>
                            <?php
                            $days_order = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $ordered = array_fill(0, 7, 0);
                            foreach ($views_weekly as $row) {
                                    $day = $row['day_name'] ?? '';
                                    $views = (int)($row['total_views'] ?? 0);
                                    $index = array_search($day, $days_order);
                                    $ordered[$index] = $views;
                            }
                            ?>

                            const viewsData = <?= json_encode(array_values($ordered), JSON_UNESCAPED_UNICODE) ?>;

                            setChart(
                                viewsData,
                                ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SÁB', 'DOM'],
                                'Visualizações esta semana',
                                'Total de views',
                                'studio-chart'
                            );
                        </script>
                    </section>

                    <section class="p-6 bg-gray600 mt-4 rounded-lg border border-white/20 flex flex-col gap-2 ">
                        <h2 class="text-white font-semibold absolute z-10 text-xl">
                            Ultimos vídeos
                        </h2>
                        <div class="mt-8 pb-4 pt-2 flex flex-col gap-4">
                            <?php foreach ($last_videos as $video) : ?>
                                <?= StudioVideoComponent(
                                    $video['id'],
                                    $video['title'],
                                    $video['thumbnail_url'],
                                    views: $video['views']
                                ) ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                </div>
                
                <section class="p-6 bg-gray600 ml-4 mt-4 rounded-lg border border-white/20 flex flex-col gap-2 max-w-[26rem]">
                    <h2 class="text-white font-semibold absolute z-10 text-xl">
                        Útimos comentários
                    </h2>
                    <div class="mt-8">
                        <?php foreach ($last_comments as $comment) : ?>
                            <?= CommentStudioAnalytics(
                                $comment['name'],
                                $comment['content'],
                                $comment['created_at'],
                                $comment['avatar_url']
                            ) ?>
                        <?php endforeach; ?>
                        
                </section>
            </div>
        </main>
</body>

</html>