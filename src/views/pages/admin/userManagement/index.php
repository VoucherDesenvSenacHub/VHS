<?php
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/components/userDataTableComponent.php";
require_once __DIR__ . "/../../../components/header/HeaderComponent.php";
require_once __DIR__ . "/../../../components/barra_admin/barra_admin.php";
require_once __DIR__ . "/../../../components/filter/filter.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/utils/sweetalert.php";

use function Src\Views\Components\userDataTableComponent\userDataTableComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\barra_admin;
use function src\views\components\utils\InputComponent;
use function src\views\components\filter\Filter;
use function Src\Application\Utils\showSweetAlert;

$users = $_SESSION["page_data"]["users"];
$nextPage = $_SESSION["page_data"]["next_page"];
$success = $_SESSION["redirect_data"]["success"] ?? null;
$errors = $_SESSION["redirect_data"]["errors"] ?? null;

unset($_SESSION["redirect_data"]);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerenciamento de usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden font-[Poppins]">
    <?= HeaderComponent() ?>

    <div class="flex flex-col md:flex-row w-full">
        <div>
            <?= barra_admin() ?>
        </div>

        <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Gerenciamento de Usuários</h1>
                    <p class="text-gray-400 mt-1">Administre os usuários da plataforma</p>
                </div>
            </div>

            <div class="bg-[#121214] border border-white/5 rounded-2xl p-4 lg:p-6 shadow-xl">
                <div class="flex flex-col md:flex-row gap-4 mb-8 items-center justify-between">
                    <div class="w-full">
                        <form method="GET" class="w-full relative">
                            <?= InputComponent(
                                placeholder: "Pesquisar usuários...",
                                type: "text",
                                name: "name",
                                value: $_GET['name'] ?? "",
                                icon: "/VHS/public/icons/filter.svg",
                                iconPosition: "right",
                                width: "full",
                                onClickIcon: "showFilterMenu()"
                            ) ?>
                            <?= Filter($_GET['name'] ?? "", $_GET['sort'] ?? "") ?>
                        </form>
                    </div>
                </div>

                <div class="w-full overflow-x-auto">
                    <?= userDataTableComponent($users, $nextPage); ?>
                </div>
            </div>

            <?php
            if (isset($errors)) {
                echo showSweetAlert("Erro ao excluir ou editar usuário", $errors, "error");
            }
            if (isset($success)) {
                echo showSweetAlert("Sucesso ao excluir ou editar usuário", $success, "success");
            }
            ?>
        </main>
    </div>
</body>

</html>