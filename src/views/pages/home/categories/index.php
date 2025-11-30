<?php
// echo "<pre class='bg-black text-white p-4 absolute z-50'>"; print_r($_SESSION["page_data"]["videos"]);echo "</pre>";
require __DIR__ . "/../../../components/header/headerComponent.php";
require __DIR__ . "/../../../components/sidebar/index.php";
require __DIR__ . "/../../../components/cards/index.php";
require __DIR__ . "/../../../components/featuredCard/featuredCardComponent.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\viewCards;
use function Views\Components\FeaturedCard\FeaturedCardComponent;

$categoryName = $_SESSION["page_data"]["category"] ?? "Não encontrado!";

$videos = $_SESSION["page_data"]["videos"] ?? [];

$FeaturedVideo = $videos[0] ?? [];

foreach ($videos as $video) {

    if ($video['views'] > $FeaturedVideo['views']) {

        $FeaturedVideo = $video;
    };
};


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>


<section class="mb-12">
    <div class="grid grid-cols-1 gap-6">
        <div class="lg:col-span-1">
            <?= !empty($videos) || !$categoryName ? FeaturedCardComponent($FeaturedVideo, true) : "" ?>
        </div>
    </div>
</section>
<section class="mb-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php

        if (count($videos) > 1) {

            echo viewCards(array_slice($videos, 1), 'videos');
        } else {

            echo "<p class='text-gray-200 text-md mb-6'>Nenhum vídeo encontrado...</p>";
        }
        ?>
    </div>
</section>


</section>
</div>
</main>
</div>
</body>

</html>