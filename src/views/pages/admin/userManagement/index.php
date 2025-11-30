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
$search = $_SESSION["page_data"]["search"] ?? '';
$sort = $_SESSION["page_data"]["sort"] ?? 'desc';
$success = $_SESSION["redirect_data"]["success"] ?? null;
$errors = $_SESSION["redirect_data"]["errors"] ?? null;

unset($_SESSION["redirect_data"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerenciamento de usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white font-[Poppins] overflow-x-hidden">
    <?= HeaderComponent() ?>
    <div class="flex">
        <div class="max-lg:hidden">
            <?= barra_admin() ?>
        </div>
        <div class="p-6 pt-8 w-full flex flex-col gap-6">
            <div class="flex flex-col gap-4">
                <div>
                    <text class='font-semibold xl:text-title text-2xl text-center md:text-left'>Gerenciamento de Usuários</text>
                </div>

                <form method="GET" class="flex flex-col gap-4">
                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                    <div class="relative cursor-pointer">
                        <?= InputComponent(
                            placeholder: "Pesquisar",
                            type: "text",
                            icon: "/VHS/public/icons/Filter.svg",
                            name: "name",
                            value: $search,
                            iconPosition: "left",
                            onClickIcon: "showFilterMenu()"
                        ) ?>

                        <?= Filter($search, $sort) ?>
                    </div>
                </form>

            </div>
            <div class="w-full overflow-x-auto">
                <?= userDataTableComponent($users, $nextPage); ?>
            </div>
            <?php
            if (isset($errors)) {
                echo showSweetAlert("Erro ao excluir ou editar usuário", $errors, "error");
            }
            if (isset($success)) {
                echo showSweetAlert("Sucesso ao excluir ou editar usuário", $success, "success");
            }
            ?>
        </div>
    </div>

    <script defer>
        const input = document.querySelector("input[name='name']");
        let timeout = null;

        input.addEventListener("input", () => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                input.form.submit();
            }, 1500);
        });
    </script>
</body>

</html>