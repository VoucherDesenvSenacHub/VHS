<?php
require "../../../components/utils/inputComponent.php";
require "./components/categoriesDataTableComponent.php";
require "../../../components/header/HeaderComponent.php";
require "../../../components/barra_admin/barra_admin.php";
require "../../../components/filter/filter.php";
require "../../../components/utils/buttonComponent.php";

use function Src\Views\Components\categoriesDataTableComponent\categoriesDataTableComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\barra_admin;
use function src\views\components\utils\InputComponent;
use function src\views\components\filter\Filter;
use function Src\Views\Components\Utils\ButtonComponent;

$users = [
    [
        'id' => '1',
        'name' => 'Tecnologia',
        'created_at' => '14/01/2024',
    ],
    [
        'id' => '2',
        'name' => 'Saúde',
        'created_at' => '14/01/2024',
    ],
    [
        'id' => '3',
        'name' => 'Moda',
        'created_at' => '14/01/2024',
    ],
    [
        'id' => '4',
        'name' => 'Estética',
        'created_at' => '14/01/2024',
    ],
    [
        'id' => '5',
        'name' => 'Jogos',
        'created_at' => '14/01/2024',
    ],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerenciamento de categorias</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white font-[Poppins]">
    <?= HeaderComponent() ?>
    <div class="flex">
        <div class="min-w-[220px] position-fixed">
            <?= barra_admin() ?>
        </div>
        <div class="p-6 pt-8 w-full flex flex-col gap-6">
            <div class="flex flex-col gap-4">
                <div>
                    <text class='text-3xl font-bold text-white cursor-default'>Gerenciamento de Categorias</text>
                </div>
                <div class=" w-full">
                    <?= InputComponent(placeholder: "Pesquisar", type: "text") ?>
                </div>
            </div>
            <div class="w-full">
                <?= categoriesDataTableComponent($users); ?>
            </div>
        </div>
    </div>
</body>

</html>