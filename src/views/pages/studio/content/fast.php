<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/CardFastComponent/cardFast.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";
require_once __DIR__ . "/../../../components/filter/filter.php";

use function Src\Application\Utils\paginate;
use function Src\Views\Components\CardFast;
use function src\views\components\filter\Filter;
use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\InputComponent;

$fasts = $_SESSION["page_data"]["fasts"] ?? [];
$nextPage = $_SESSION["page_data"]["next_page"] ?? 0;
$search = $_SESSION["page_data"]["search"] ?? '';
$sort = $_SESSION["page_data"]["sort"] ?? 'desc';

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
                <h1 class="mt-8 font-semibold xl:text-title text-xl md:text-2xl text-white">Conteúdo do canal</h1>
                <p class="text-gray-400 text-sm mt-1">Gerencie seus vídeos curtos</p>
            </div>
            <div class="my-4 flex gap-2 w-full flex-col md:w-96 md:flex-row">
                <?php
                echo ButtonComponent(text: "Videos", variant: "studio", link: "/VHS/studio/content/video", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]");
                echo ButtonComponent(text: "Fast", variant: "studio", link: "/VHS/studio/content/fast", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]");
                echo ButtonComponent(text: "Eventos", variant: "studio", link: "/VHS/studio/content/event", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]");
                ?>
            </div>

            <form action="" method="get" class="flex flex-col gap-4">
                <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                <div class="relative cursor-pointer">
                    <?= InputComponent(
                        type: "text",
                        placeholder: "Pesquisar",
                        icon: "/VHS/public/icons/Filter.svg",
                        name: "search",
                        value: $search,
                        iconPosition: "left",
                        onClickIcon: "showFilterMenu()"
                    ) ?>
                    <?= Filter($search, $sort) ?>
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-5">
                <?php
                foreach ($fasts as $fast) {
                    echo CardFast([
                        'id' => $fast['id'],
                        'thumbnail_url' => "/VHS/public/thumbnails/" . $fast['thumbnail_url'],
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

        function showFilterMenu() {
            const filter = document.getElementById('filter');
            filter.classList.toggle('hidden');
        }
    </script>
</body>

<?php
unset($_SESSION["redirect_data"]);

if (!isset($_GET['search'])) {
    unset($_SESSION['page_data']['search']);
}
?>

</html>