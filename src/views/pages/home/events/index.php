<?php

    require_once __DIR__ . "/../../../components/header/headerComponent.php";
    require_once __DIR__ . "/../../../components/sidebar/index.php";
    require_once __DIR__ . "/../../../components/cards/index.php";

    use function Src\Views\Components\Header\HeaderComponent;
    use function Src\Views\Components\Sidebar\SidebarComponent;
    use function Src\Views\Components\Cards\viewCards;

    $events = $_SESSION["page_data"]["events"] ?? [];

?>

<!-- H T M L -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Eventos</title>

    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body>
    <div class="w-full h-auto">
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <?= SidebarComponent() ?>

        <main class="flex-1 p-10 mx-auto">
            <div class="max-w-[1500px] mx-auto">
                <section class="mb-12">
                    <div>
                        <h2 class="text-2xl font-bold text-white"><span class="text-purple-400">#</span> Daqui a pouco 🚀</h2>
                        <p class="text-gray-400 text-sm mb-6">Recomendados para você</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?= viewCards($events, "events"); ?>   
                    </div>
                </section>
            </div>
        </main>
    </div>

</body>
</html>