<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";
require_once __DIR__ . "/../../../components/utils/sweetalert.php";
require_once __DIR__ . "/../../../components/filter/filter.php";

use function Src\Application\Utils\paginate;
use function Src\Application\Utils\showSweetAlert;
use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\Cards\viewCards;
use function src\views\components\filter\Filter;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\InputComponent;

$videos = $_SESSION["page_data"]["videos"];

$success_edit = $_SESSION["redirect_data"]["success_edit"] ?? null;

$success_delete = $_SESSION["redirect_data"]["success_delete"] ?? null;
$nextPage = $_SESSION["page_data"]["next_page"];
$search = $_SESSION["page_data"]["search"] ?? '';
$sort = $_SESSION["page_data"]["sort"] ?? 'desc';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Conteúdo do canal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
    <?= HeaderComponent(); ?>

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>

        <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

            <div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">Conteúdo do canal</h1>
                    <p class="text-gray-400 mt-1">Gerencie seus vídeos</p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 mb-8 items-center justify-between">
                <!-- Custom Tabs -->
                <div class="flex p-1 bg-[#121214] border border-white/5 rounded-xl w-full lg:w-auto">
                    <a href="/VHS/studio/content/video" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium bg-purple-600 text-white shadow-lg transition-all text-center">
                        Vídeos
                    </a>
                    <a href="/VHS/studio/content/fast" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all text-center">
                        Shorts
                    </a>
                </div>

                <!-- Premium Search Input -->
                <form action="" method="get" class="flex flex-col md:flex-row gap-4 w-full lg:w-auto items-center">
                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                    <?= InputComponent(
                        type: "text",
                        placeholder: "Pesquisar vídeos...",
                        name: "search",
                        icon: "/VHS/public/icons/Filter.svg",
                        value: $search
                    ) ?>
                    <?= Filter($search, $sort) ?>
                </form>
            </div>

            <?php if (empty($videos)): ?>
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <h3 class="text-xl font-bold text-white mb-2">Nenhum vídeo encontrado</h3>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?= viewCards($videos, 'mychannel'); ?>
                </div>

                <div class="mt-8">
                    <?= paginate($videos, $nextPage) ?>
                </div>
            <?php endif; ?>

        </main>
    </div>

    <?php
    if (isset($success_edit)) {
        echo showSweetAlert("Vídeo editado com sucesso!", "", "success");
    }

    if (isset($success_delete)) {
        echo showSweetAlert("Vídeo deletado com sucesso!", "", "success");
    }
    ?>

    <script src="/VHS/src/views/components/cards/script.js" defer></script>
    <script defer>
        const input = document.querySelector("input[name='search']");
        let timeout = null;

        input.addEventListener("input", () => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                input.form.submit();
            }, 1000);
        });
    </script>
</body>

<?php
unset($_SESSION["redirect_data"]);

if (!isset($_GET['search'])) {
    unset($_SESSION['page_data']['search']);
}
?>

</html>