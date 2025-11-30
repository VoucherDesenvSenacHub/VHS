<?php
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/components/categoriesDataTableComponent.php";
require_once __DIR__ . "/../../../components/header/HeaderComponent.php";
require_once __DIR__ . "/../../../components/barra_admin/barra_admin.php";
require_once __DIR__ . "/../../../components/filter/filter.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/utils/sweetalert.php";

use function Src\Views\Components\categoriesDataTableComponent\categoriesDataTableComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\barra_admin;
use function src\views\components\utils\InputComponent;
use function Src\Application\Utils\showSweetAlert;
use function src\views\components\filter\Filter;

$categoryData = $_SESSION["page_data"]["list"] ?? [];
$next_page_categories = $_SESSION["page_data"]["next_page_categories"] ?? 0;
$search = $_SESSION["page_data"]["search"] ?? '';
$sort = $_SESSION["page_data"]["sort"] ?? 'desc';

$errors = $_SESSION['redirect_data']['errors'] ?? [];
$success = $_SESSION["redirect_data"]["success"] ?? null;
$fields = $_SESSION['redirect_data']['fields'] ?? [];
unset($_SESSION['redirect_data']);

if (!empty($errors) && is_array($errors)) {
    foreach ($errors as $error) {
        if (str_contains(strtolower($error), 'nameCategory')) {
            $nameCategoryError = $error;
        } else {
            $genericError = $error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerenciamento de categorias</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden font-[Poppins]">
    <?= HeaderComponent() ?>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= barra_admin() ?>
        </div>

        <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Gerenciamento de Categorias</h1>
                    <p class="text-gray-400 mt-1">Organize o conteúdo da plataforma</p>
                </div>
                <button id="openModalBtn" type="button" class="flex items-center gap-2 px-6 py-3 bg-[#660BAD] hover:bg-[#7a15c5] text-white rounded-xl transition-all shadow-lg shadow-purple-900/20 font-medium">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nova Categoria
                </button>
            </div>

            <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">
                <div class="flex flex-col md:flex-row gap-4 mb-8 items-center justify-between">
                    <div class="w-full">
                        <form method="get" class="w-full relative">
                            <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                            <?= InputComponent(
                                placeholder: "Pesquisar categorias...",
                                type: "text",
                                icon: "/VHS/public/icons/filter.svg",
                                name: "search",
                                value: $search,
                                iconPosition: "left",
                                width: "full",
                                onClickIcon: "showFilterMenu()"
                            ) ?>
                            <?= Filter($search, $sort) ?>
                        </form>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <?= categoriesDataTableComponent($categoryData, $next_page_categories); ?>
                </div>
            </div>

            <?php
            if (!empty($errors) && is_array($errors)) {
                $errorMessage = is_array($errors) ? implode(", ", $errors) : $errors;
                echo showSweetAlert($errorMessage, "", "error");
            }
            if (isset($success)) {
                echo showSweetAlert($success, "", "success");
            }
            ?>
        </main>
    </div>

    <!-- Create Category Modal -->
    <div id="modalOverlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden transition-opacity duration-300 z-40"></div>
    <div id="categoryModal" class="fixed inset-0 flex items-center justify-center hidden z-50 p-4">
        <div class="w-full max-w-md bg-[#121214] border border-white/10 rounded-2xl p-6 shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
            <div class="flex flex-col gap-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Nova Categoria</h2>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="/VHS/src/application/routes/route.php/api/v1/admin/categories">
                    <div class="flex flex-col gap-4">
                        <?= InputComponent(
                            placeholder: "Nome da categoria",
                            name: "nameCategory",
                            type: "text",
                            value: isset($fields["nameCategory"]) ? $fields["nameCategory"] : "",
                            error: isset($errors["nameCategory"]),
                            errorDescription: isset($errors["nameCategory"]) ? $errors["nameCategory"] : "",
                            label: "Nome",
                            width: "full"
                        ) ?>

                        <div class="flex gap-3 mt-2">
                            <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                                Cancelar
                            </button>
                            <button id="saveCategoryBtn" type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-[#660BAD] hover:bg-[#7a15c5] text-white transition-colors font-medium shadow-lg shadow-purple-900/20">
                                Criar Categoria
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const modalOverlay = document.getElementById('modalOverlay');
        const categoryModal = document.getElementById('categoryModal');
        const modalContent = categoryModal.querySelector('div');
        const input = document.querySelector("input[name='search']");
        let timeout = null;

        function openModal() {
            modalOverlay.classList.remove('hidden');
            categoryModal.classList.remove('hidden');
            // Force reflow
            void categoryModal.offsetWidth;

            modalOverlay.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }

        function closeModal() {
            modalOverlay.classList.add('opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modalOverlay.classList.add('hidden');
                categoryModal.classList.add('hidden');
            }, 300);
        }

        openModalBtn.addEventListener('click', openModal);
        modalOverlay.addEventListener('click', closeModal);

        input.addEventListener("input", () => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                input.form.submit();
            }, 1500);
        });
    </script>
</body>

</html>