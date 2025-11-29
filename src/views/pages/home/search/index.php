<?php



$dados = $_SESSION["page_data"]["dados"] ?? [];
// $videos = $_SESSION["page_data"]["videos"] ?? [];

// $fast = $_SESSION["page_data"]["fast"] ?? [];

require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";
require_once __DIR__ . "/../../../components/featuredCard/featuredCardComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/channel/channelComponent.php";
// require_once __DIR__ . "/../../../components/CardFastComponent/cardFast.php";
require_once __DIR__ . "/../../../../controllers/SearchVideoController.php";


use function Src\Views\Components\Cards\renderCards;
use function Src\Views\Components\Channel\channelComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function src\Views\Components\CardFast;
use src\Application\Controllers\SearchVideoController;




$term = isset($_GET['term']) ? htmlspecialchars($_GET['term']) : '';
$filter = isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : 'video';
$query = isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '';


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
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 px-4 sm:px-6 py-4 max-w-[1500px] mx-auto">
            <div>
                <h2 class="text-2xl font-bold text-white mb-2"><span class="text-purple-400">#</span> Resultados para "<?= $query ?>"</h2>
                <p class="text-gray-400 text-sm mb-6">Confira os resultado para "<?= $query ?>" com a categoria desejada</p>
                <div class="flex gap-2 w-[900px] mb-6">
                    <?= ButtonComponent("Vídeos", "studio", "",10.675, 2.5, 1, "?term=$term&filter=video&query=$query") ?>
                    <?= ButtonComponent("Fast", "studio", "",10.675, 2.5, 1, "?term=$term&filter=fast&query=$query") ?>
                    <?= ButtonComponent("Eventos", "studio", "",10.675, 2.5, 1, "?term=$term&filter=event&query=$query") ?>
                    <?= ButtonComponent("Canais", "studio", "",10.675, 2.5, 1, "?term=$term&filter=channels&query=$query") ?>
                </div>
            </div>
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 <?= $filter === 'channels' ? '!grid-cols-1' : ''?>">

                <?php
                if ($filter != "channels") {
                    echo renderCards($dados, $filter); 

                } 
                else if ($filter == "channels") {
                    foreach ($dados as $channel) {
                        echo ChannelComponent($channel);
                    }
                }
                ?>
        
            </section>
        </main>

    </div>
</body>
</html>