<?php
require "../../components/utils/inputComponent.php";
require "./components/userDataTableComponent/userDataTableComponent.php";
require "../../components/header/HeaderComponent.php";
require "../../components/barra_admin/barra_admin.php";
require "../../components/filter/filter.php";
require "../../components/utils/buttonComponent.php";

use function Src\Views\Components\userDataTableComponent\userDataTableComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\barra_admin;
use function src\views\components\utils\InputComponent;
use function src\views\components\filter\Filter;
use function Src\Views\Components\Utils\ButtonComponent;

$users = [
    [
        'name' => 'Bruna Gomes Louveira Miranda',
        'username' => 'Rafael',
        'id' => '456aea2d12345678',
        'status' => 'Ativo',
        'role' => 'Usuário',
        'joined' => '14/01/2024',
        'profile_picture' => 'https://github.com/shadcn.png',
    ],
    [
        'name' => 'Rafael Costa',
        'username' => 'Rafael_',
        'id' => '789bcdf12345678',
        'status' => 'Ativo',
        'role' => 'Administrador',
        'joined' => '19/02/2024',
        'profile_picture' => 'https://github.com/shadcn.png',
    ],
    [
        'name' => 'Rafael Silva',
        'username' => 'Rafael',
        'id' => '456aea2d12345678',
        'status' => 'Suspenso',
        'role' => 'Usuário',
        'joined' => '14/01/2024',
        'profile_picture' => 'https://github.com/shadcn.png',
    ],
    [
        'name' => 'Rafael Costa',
        'username' => 'Rafael_',
        'id' => '789bcdf12345678',
        'status' => 'Ativo',
        'role' => 'Criador de conteúdo',
        'joined' => '19/02/2024',
        'profile_picture' => 'https://github.com/shadcn.png',
    ],
    [
        'name' => 'Rafael Silva',
        'username' => 'Rafael',
        'id' => '456aea2d12345678',
        'status' => 'Ativo',
        'role' => 'Usuário',
        'joined' => '14/01/2024',
        'profile_picture' => 'https://github.com/shadcn.png',
    ],
    [
        'name' => 'Rafael Costa',
        'username' => 'Rafael_',
        'id' => '789bcdf12345678',
        'status' => 'Ativo',
        'role' => 'Criador de conteúdo',
        'joined' => '19/02/2024',
        'profile_picture' => 'https://github.com/shadcn.png',
    ],
    [
        'name' => 'Rafael Costa',
        'username' => 'Rafael_',
        'id' => '789bcdf12345678',
        'status' => 'Ativo',
        'role' => 'Criador de conteúdo',
        'joined' => '19/02/2024',
        'profile_picture' => 'https://github.com/shadcn.png',
    ],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerenciamento de usuários</title>
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
                    <text class='text-3xl font-bold text-white cursor-default'>Gerenciamento de Usuários</text>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex gap-4">
                        <?php echo ButtonComponent("Usuários", "studio", "", 10.675, 2.5, "", "../userManagement/index.php"); ?>
                        <?php echo ButtonComponent("Denúncias", "studio", "", 10.675, 2.5, "", "../complaintManagement/index.php"); ?>
                    </div>
                    <div class="flex items-center justify-center gap-4">
                        <div class="h-full pt-6">
                            <?= Filter() ?>
                        </div>
                        <div class="w-full">
                            <?= InputComponent(placeholder: "Pesquisar", type: "text") ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full">
                <?= userDataTableComponent($users); ?>
            </div>
        </div>
    </div>
</body>

</html>