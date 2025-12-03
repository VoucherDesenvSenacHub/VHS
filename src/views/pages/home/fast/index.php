<?php
require_once __DIR__ . '/../../../components/header/headerComponent.php';
require_once __DIR__ . "/../../../components/fastComponent/fastComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";

use function src\views\components\FastComponent\FastComponent;
use function src\views\components\header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;

$fasts = $_SESSION["page_data"];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Fasts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="/VHS/src/views/pages/home/fast/script.js" defer></script>
    <script src="/VHS/src/views/components/fastComponent/fastComponent.js" defer></script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }


        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#100018] to-black text-white min-h-screen flex flex-col overflow-hidden">

    <?= HeaderComponent() ?>

    <div class="flex flex-1 h-screen">
        <div>
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 lg:ml-64 w-full h-full flex justify-center relative">

            <section onscroll="sectionFastScroll(event)"
                class="w-full h-[92vh] overflow-y-scroll snap-y snap-mandatory no-scrollbar scroll-smooth pb-0 lg:pb-10 lg:ml-10 lg:max-w-full">

                <?php if (empty($fasts)): ?>
                    <div class="flex flex-col items-center justify-center h-full text-center p-6 space-y-4">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Nenhum Fast encontrado</h2>
                        <p class="text-gray-400">Tente novamente mais tarde.</p>
                    </div>
                <?php else: ?>
                    <?php
                    foreach ($fasts as $fast) {
                        echo FastComponent(
                            [
                                "id" => $fast["id"],
                                "url" => "/VHS/public/videos/" . $fast["url"],
                                "title" => $fast["title"],
                                "user" => $fast["username"],
                                "avatar_url" => $fast["avatar_url"],
                                "user_liked" => $fast["user_liked"],
                                "likes" => $fast["likes"]
                            ]
                        );
                    }
                    ?>
                <?php endif; ?>

            </section>

        </main>
    </div>

</body>

</html>