<?php
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/components/categoriesDataTableComponent.php";
require_once __DIR__ . "/../../../components/header/HeaderComponent.php";
require_once __DIR__ . "/../../../components/barra_admin/barra_admin.php";
require_once __DIR__ . "/../../../components/filter/filter.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";

use function Src\Views\Components\categoriesDataTableComponent\categoriesDataTableComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\barra_admin;
use function src\views\components\utils\InputComponent;

$categoryData = $_SESSION["page_data"]["list"] ?? [];
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
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white font-[Poppins]">
    <?= HeaderComponent() ?>
    <div class="flex gap-10">
        <div class="min-w-[220px] position-fixed">
            <?= barra_admin() ?>
        </div>
        <div class="p-6 pt-8 w-full flex flex-col gap-6">
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-center">
                    <div>
                        <text class='text-3xl font-bold text-white cursor-default'>Gerenciamento de Categorias</text>
                    </div>
                    <div class="flex">
                        <button id="openModalBtn" type="button" class="bg-[#660BAD] transition-colors hover:bg-purple-700 text-gray-50 px-4 py-2 rounded-md w-[200px] h-[50px]">Cadastrar</button>
                    </div>
                </div>
                <div class="w-full">
                    <?= InputComponent(placeholder: "Pesquisar", type: "text") ?>
                </div>
            </div>
            <div class="w-full">
                <?= categoriesDataTableComponent($categoryData); ?>
            </div>
        </div>
    </div>

    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden transition-opacity duration-300"></div>
    <div id="categoryModal" class="fixed inset-0 flex items-center justify-center hidden">
        <div class="min-w-[400px] flex flex-col gap-4 p-8 px-10 bg-gray-900 text-gray-50 border border-gray-700 p-4 rounded-lg transform -translate-y-12 transition-transform duration-300">
            <div class="flex justify-center items-center">
                <h2 class="text-2xl font-bold text-white cursor-default">Criar Categoria</h2>
            </div>
            <form method="POST" action="/VHS/src/application/routes/route.php/api/v1/admin/categories">
                <div class="flex flex-col w-full">
                    <div class="flex w-full justify-start">
                        <label for="categoryName" class="text-right text-gray-300">Nome</label>
                    </div>
                    <input name="nameCategory" id="categoryName" type="text" class="col-span-3 bg-gray-800 border border-gray-700 text-gray-50 p-2 rounded" placeholder="Digite o nome" />
                </div>
                <div class="mt-4 flex justify-between gap-2">
                    <button id="closeModalBtn" type="button" class="outline outline-1 px-4 py-2 outline-[#660BAD] rounded-md transition-colors hover:bg-gray-800 w-[200px] h-[50px]">Cancelar</button>
                    <button id="saveCategoryBtn" type="submit" class="bg-[#660BAD] hover:bg-purple-700 text-gray-50 transition-colors px-4 py-2 rounded-md w-[200px] h-[50px]">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const modalOverlay = document.getElementById('modalOverlay');
        const categoryModal = document.getElementById('categoryModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const saveCategoryBtn = document.getElementById('saveCategoryBtn');

        function openModal() {
            modalOverlay.classList.remove('hidden');
            categoryModal.classList.remove('hidden');
            setTimeout(() => {
                modalOverlay.classList.add('opacity-100');
                categoryModal.querySelector('div').classList.remove('scale-0');
                categoryModal.querySelector('div').classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            modalOverlay.classList.remove('opacity-100');
            categoryModal.querySelector('div').classList.remove('scale-100');
            categoryModal.querySelector('div').classList.add('scale-0');
            setTimeout(() => {
                modalOverlay.classList.add('hidden');
                categoryModal.classList.add('hidden');
            }, 300);
        }

        openModalBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);
        saveCategoryBtn.addEventListener('click', () => {
            console.log('Category Name:', document.getElementById('categoryName').value);
            closeModal();
        });

        modalOverlay.addEventListener('click', closeModal);
    </script>
</body>

</html>