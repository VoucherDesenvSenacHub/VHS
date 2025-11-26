<?php
require_once __DIR__ . '/../../../components/utils/buttonComponent.php';
require_once __DIR__ . '/../../../components/utils/inputComponent.php';
require_once __DIR__ . '/../../../components/header/headerComponent.php';
require_once __DIR__ . '/../../../components/sidebar/index.php';
require_once __DIR__ . '/../../../components/shared/shared.php';

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\views\Components\sidebar\SidebarComponent;

$user = $_SESSION["page_data"]["user"] ?? [];
$categories = $_SESSION["page_data"]["categories"] ?? [];
$errors = $_SESSION["redirect_data"]["errors"] ?? [];
$avatar_url = !empty($user['avatar_url']) ? $user['avatar_url'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="/VHS/src/views/pages/user/settings/script.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] text-white">
    <script>
        var categories = [];
        var userCategories = [];

        <?php foreach ($categories as $category): ?>
            categories.push("<?= $category["name"] ?>");
        <?php endforeach; ?>

        <?php foreach ($user["categories"] as $category): ?>
            userCategories.push("<?= $category["name"] ?>");
        <?php endforeach; ?>
    </script>
    <div>
        <?= HeaderComponent() ?>
    </div>
    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>
        <div class="flex flex-col gap-4 p-6 w-full max-w-[1200px] mx-auto">
            <div class="w-full">
                <h2 class="text-xl md:text-3xl font-bold text-white text-center md:text-left">Gerenciar Perfil</h2>
            </div>
            <form class="flex flex-col gap-10 rounded-xl w-full"
                method="post"
                action="/VHS/api/v1/user/settings"
                enctype="multipart/form-data"
                id="form">
                <div class="flex flex-col md:flex-row items-center gap-4 w-full">
                    <div class="w-36 h-36 relative overflow-hidden rounded-full">
                        <img id="profileImage" src="/VHS/public/uploads/avatars/<?= $avatar_url ?>" class="object-cover w-full h-full">
                    </div>
                    <div class="flex space-x-3 w-full md:w-[28rem]">
                        <button id="uploadButton"
                            class="bg-purple-700 hover:bg-purple-800 text-white rounded w-full h-[40px] md:h-[48px] text-sm md:text-base"
                            type="button">
                            Carregar foto
                        </button>
                        <button id="deleteButton"
                            class="w-full h-[40px] md:h-[48px] outline outline-1 outline-purple-500 text-white rounded text-sm md:text-base"
                            type="button">
                            Excluir
                        </button>
                    </div>
                    <input type="file" name="avatar" id="imageUpload" accept="image/*" class="hidden">
                </div>
                <div class="flex flex-col gap-6 w-full ">
                    <?= InputComponent(
                        placeholder: "@UsuárioSenac12333",
                        name: "name",
                        type: "text",
                        label: "Nome de Usuário",
                        value: $user["name"],
                    ) ?>
                    <?= InputComponent(
                        placeholder: "@UsuárioSenac12333",
                        name: "username",
                        type: "text",
                        label: "Usuário",
                        value: $user["username"],
                        error: $errors["username"] ?? "",
                        errorDescription: $errors["username"] ?? "",
                    ) ?>
                    <?= InputComponent(
                        placeholder: "Usuario123@gmail.com",
                        name: "email",
                        type: "email",
                        label: "E-mail",
                        value: $user["email"],
                        error: isset($errors["email"]) ? true : "",
                        errorDescription: $errors["email"] ?? "",
                    ) ?>
                    <?= InputComponent(
                        placeholder: "Sua senha atual",
                        name: "password",
                        type: "password",
                        label: "Senha",
                    ) ?>
                    <?= InputComponent(
                        placeholder: "Sua nova senha",
                        name: "new_password",
                        type: "password",
                        label: "Nova senha",
                    ) ?>
                    <div class="flex flex-col gap-2">
                        <label class="text-gray-300 font-medium">Categorias que você se interessa</label>
                        <div id="categoryButtons" class="flex flex-wrap gap-2">
                            <?php foreach ($categories as $category): ?>
                                <button type="button"
                                    class="category-btn px-4 py-2 rounded-xl border border-purple-600 text-white hover:bg-purple-700"
                                    data-id="<?= $category['id'] ?>">
                                    <?= $category['name'] ?>
                                </button>
                            <?php endforeach; ?>
                            <input type="text" hidden name="categories[]" id="categoriesInput">
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between w-full md:w-[28rem] self-end gap-4">
                    <?= ButtonComponent("Cancelar", "outline", null, type: "button"); ?>
                    <?= ButtonComponent("Salvar", "default", null, type: "submit"); ?>
                </div>
            </form>
        </div>
        <?php
        if ($errors) {
            echo "<script>alert('Existem erros no formulário, por favor verifique os campos!');</script>";
        }
        ?>
    </div>
</body>

</html>

<script>
    document.getElementById('uploadButton').onclick = () => document.getElementById('imageUpload').click();

    document.getElementById('imageUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (ev) => document.getElementById('profileImage').src = ev.target.result;
        reader.readAsDataURL(file);
    });

    document.getElementById('deleteButton').onclick = () => {
        document.getElementById('profileImage').src = '/VHS/public/images/foto-sem-perfil.jpg';
        document.getElementById('imageUpload').value = '';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_avatar';
        input.value = '1';
        document.getElementById('form').appendChild(input);
    };
</script>