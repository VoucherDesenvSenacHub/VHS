<?php
require __DIR__ . "/../../../components/utils/buttonComponent.php";
require __DIR__ . "/../../../components/header/headerComponent.php";
require __DIR__ . "/../../../components/utils/footer.php";
require __DIR__ . "/../../../components/sidebar/index.php";
// require __DIR__ . "/../../../components/cards/videoCard.php";
// require __DIR__ . "/../../../components/cards/channelCard.php";
require __DIR__ . "/../../../components/cards/index.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\sidebar\SidebarComponent;
use function src\views\components\header\HeaderComponent;
use function Src\Views\Components\utils\Footer;
// use function Src\Views\Components\Cards\renderCards;

$creator = $_SESSION["page_data"]["channel"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>VHS - Canal</title>
</head>

<body>
    <div class="flex flex-col justify-between">
        <header>
            <?= HeaderComponent(); ?>
        </header>
        <div class="flex flex-col md:flex-row w-full">
            <div class="hidden md:block">
                <?= SidebarComponent(); ?>
            </div>
            <main class="flex flex-col flex-grow px-4 sm:px-8 md:px-12 -mt-8 max-w-[1500px] w-full mx-auto">
                <div id="Content" class="mt-6 sm:mt-12 w-full">
                    <div class="relative rounded-2xl overflow-hidden">
                        <?php if (!empty($creator['banner_url'])): ?>
                            <img
                                src="/VHS/public/uploads/banners/<?= $creator['banner_url'] ?>"
                                class="w-full h-48 sm:h-64 md:h-72 lg:h-80 object-cover rounded-2xl"
                                alt="Banner do canal">
                        <?php else: ?>
                            <div class="w-full h-48 sm:h-64 md:h-72 lg:h-80 flex items-center justify-center rounded-2xl bg-gradient-to-b from-[#2a192f] to-[#33263b]">
                                <span class="text-6xl font-bold text-white/20">VHS</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col lg:flex-row w-full justify-between ">
                        <div class="flex flex-row">
                            <div class="w-24 h-24 sm:w-36 sm:h-36 rounded-3xl border-1 border-white/20 overflow-hidden -mt-20 md:-mt-16 ml-4 sm:ml-6 z-10 relative">
                                <img src="/VHS/public/uploads/avatars/<?= $creator['avatar_url'] ?? "/VHS/public/uploads/avatars/default.png" ?>" class=" object-cover h-full" alt="Perfil">
                            </div>
                            <div class="flex flex-col md:flex-row items-start sm:items-center mt-4 sm:mt-6 ml-4 sm:ml-6 gap-4 ">
                                <div>
                                    <h1 class="text-white font-bold text-2xl"><?= $creator['username']; ?></h1>
                                    <p class="text-gray-300">
                                        <?= $creator['followers'] ?> seguidores
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="self-end w-96">
                            <?= ButtonComponent('Seguir', 'outline', null) ?>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row justify-between mt-6 gap-6">
                    <div class="md:w-2/3">
                        <p class="text-gray-300 text-sm sm:text-base">
                            <?= $creator['description_channel'] ?>
                        </p>
                    </div>
                </div>
                <div class="mt-10">
                    <h1 class="text-white font-bold text-2xl">Conteúdo do Canal</h1>
                    <p class="text-gray-300 mb-4">Confira os vídeos mais populares da nossa plataforma VHS</p>
                    <section class="mb-12">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <!-- <?php
                                    foreach ($videos as $video) {
                                        echo renderCards($cards, 'channels');
                                    }
                                    ?> -->


                        </div>
                    </section>
                </div>
            </main>
        </div>
        <footer>
            <?= Footer() ?>
        </footer>
    </div>
</body>

</html>