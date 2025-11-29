<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/CardFastComponent/cardFast.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";

use function Src\Application\Utils\paginate;
use function Src\Views\Components\CardFast;
use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\InputComponent;

$fasts = $_SESSION["page_data"]["fasts"] ?? [];
$nextPage = $_SESSION["page_data"]["next_page"] ?? 0;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Conteúdo do canal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="w-full bg-[#0C0118]">
    <?php echo HeaderComponent(); ?>
    <div class="flex">
        <div class="max-xl:hidden mr-4">
            <?php
            echo StudioSideMenuComponent();
            ?>
        </div>
        <div class="max-w-[1500px] w-full mx-auto px-6">
            <div>
                <h1 class="font-semibold text-title text-white">Conteúdo do canal</h1>
            </div>
            <div class="flex gap-4 w-96 my-4">
                <?php
                    echo ButtonComponent("Videos", "studio", "", 10.675, 2.5,"",'/VHS/studio/content/video');
                    echo ButtonComponent("Fast", "studio", "", 10.675, 2.5,"","/VHS/studio/content/fast");
                    echo ButtonComponent("Eventos", "studio", "", 10.675, 2.5,"","/VHS/studio/content/event");
                ?>
            </div>  

            <form action="" method="get">
                <?= InputComponent(
                    type: "text",
                    placeholder: "Pesquisar",
                    icon: "/VHS/public/icons/Filter.svg",
                    name: "search",
                    value: $_SESSION['page_data']['search'] ?? '',
                    iconPosition: "left",
                    onClickIcon: "showFilterMenu()"
                ) ?>
            </form>

            <div id="filter" class="absolute left-[16.5rem] z-10 hidden flex flex-col bg-gray-900 rounded-lg p-2 max-w-32 border-[0.5px] border-gray-500">
                <div class="flex">
                    <img src="/VHS/public/icons/time-svgrepo-com.svg" alt="" class="size-6 rotate-[-110deg]">
                    <p class="text-[13px] flex items-center text-gray-200">Mais recentes</p>
                </div>
                <div class="flex flex-row">
                    <img src="/VHS/public/icons/time-svgrepo-com.svg" class="size-6" alt="">
                    <p class="text-[13px] flex items-center text-gray-200">Mais antigos</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-5">
                <?php
                    foreach ($fasts as $fast) {
                        echo CardFast([
                            'id' => $fast['id'],
                            'thumbnail_url' => $fast['thumbnail_url'],
                            'titulo' => $fast['title'],
                            'likes' => $fast['likes'] ?? '0',
                            'views' => $fast['views'] ?? '0'
                        ]);     
                    }
                ?>
            </div>
            <div class="mb-5">
                <?= paginate($fasts, $nextPage) ?>
            </div>
        </div>
    </div>
    <script defer>
        const input = document.querySelector("input[name='search']");
        let timeout = null;

        input.addEventListener("input", () => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                input.form.submit();
            }, 1500);
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