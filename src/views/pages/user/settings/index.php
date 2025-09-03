<?php
require __DIR__ . '/../../../components/utils/buttonComponent.php';
require __DIR__ . '/../../../components/utils/inputComponent.php';
require __DIR__ . '/../../../components/header/headerComponent.php';

require __DIR__ . '/../../../components/sidebar/SidebarComponent.php';

require __DIR__ . '/../../../components/shared/shared.php';


use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\views\Components\sidebar\SidebarComponent;

$user = $_SESSION["page_data"]["user"] ?? [];
$categories = $_SESSION["page_data"]["categories"] ?? [];
$errors = $_SESSION["redirect_data"]["errors"] ?? [];
# print_r($user["categories"]);
$avatar_url = !empty($user['avatar_url']) ? $user['avatar_url'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="/VHS/src/views/pages/user/settings/script.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
</head>

<body
class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <script>
        var categories = []
        var userCategories = []
        <?php foreach($categories as $category): ?>
            categories.push("<?= $category["name"] ?>")
        <?php endforeach; ?>

        <?php foreach($user["categories"] as $category): ?>
            userCategories.push("<?= $category["name"] ?>")
        <?php endforeach; ?>
    </script>
    <!-- <div class="h-full w-full bg-black/40 fixed z-30">

    </div> -->
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= SidebarComponent() ?>
    </div>
    <div class="flex flex-col gap-4 p-6 flex-grow max-w-[1200px] mx-auto ">
    <div>
        <h2 class="font-semibold text-3xl text-gray-200 mb-2">Gerenciar Perfil</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cum repellat expedita beatae distinctio magnam sequi dolorum aliquam. Omnis ab laudantium sunt perferendis rerum. Architecto quae exercitationem laborum dolorum vitae.</p>
    </div>
    <form class="flex flex-col gap-8 rounded-xl" method="post" action="/VHS/api/v1/user/settings" enctype="multipart/form-data" id="form">
        <!-- <h2 class="text-xl font-semibold">Informações do perfil</h2> -->
        <div class="flex items-center gap-4 w-full">
            <div class="w-36 h-36 relative flex  shrink-0 overflow-hidden rounded-full">
                <img id="profileImage" src="/VHS/public/uploads/avatars/<?=$avatar_url?>" alt="Imagem de Perfil" class="object-cover w-full h-full">
            </div>
            <div class="flex space-x-3 w-96">
                <button id="uploadButton" class="bg-purple-700 transition-colors hover:bg-purple-800 text-white rounded flex justify-center items-center w-full h-[40px] gap-2 rounded-md cursor-pointer " type="button">Carregar foto</button>
                <button id="deleteButton" class="flex justify-center items-center w-full h-[40px] gap-2 rounded-md cursor-pointer outline outline-1 outline-purple-500 text-white" type="button">Excluir</button>
            </div>
            <input type="file" name="avatar" id="imageUpload" accept="image/*" class="hidden">
        </div>
        <div class="flex flex-col gap-6">
            <?= InputComponent(
                placeholder: "@UsuárioSenac12333",
                name: "name",
                type: "text",
                label: "Nome de Usuário",
                icon: "/VHS/public/icons/userRound.svg",
                iconPosition: "left-1",
                value: $user["name"]
            ) ?>
            <?= InputComponent(
                placeholder: "@UsuárioSenac12333",
                name: "username",
                type: "text",
                label: "Usuário",
                icon: "/VHS/public/icons/userRound.svg",
                iconPosition: "left-1",
                value: $user["username"],
                error: $errors["username"] ?? null,
                errorDescription: $errors["username"] ?? null,
            ) ?>
            <?= InputComponent(
                placeholder: "Usuário123@gmail.com",
                name: "email",
                type: "email",
                label: "E-mail",
                icon: "/VHS/public/icons/mail.svg",
                iconPosition: "left-1",
                value: $user["email"],
                error: isset($errors["email"]) ? true : null,
                errorDescription: $errors["email"] ?? null,
            ) ?>
            <?= InputComponent(
                placeholder: "Senha123",
                name: "password",
                type: "password",
                label: "Senha",
                icon: "/VHS/public/icons/lock.svg",
                iconPosition: "left-1",
            ) ?>
            <?= InputComponent(
                placeholder: "Senha123",
                name: "new_password",
                type: "password",
                label: "Nova senha",
                icon: "/VHS/public/icons/lock.svg",
                iconPosition: "left-1",
            ) ?>
            <div class="flex flex-col gap-2 w-full">
                <label class="text-gray-300 font-medium">Categorias que você se interessa</label>
                <div id="categoryButtons" class="flex flex-wrap gap-2">
                    <?php foreach($categories as $category): ?>
                        <button type="button" 
                            class="category-btn px-4 py-2 rounded-xl border border-purple-600 text-white transition-colors"
                            data-id="<?= $category['id'] ?>">
                            <?= $category['name'] ?>
                        </button>
                    <?php endforeach; ?>

                    <input type="text" hidden name="categories[]" id="categoriesInput">
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between w-full w-[30rem] gap-4 self-end">
            <?= ButtonComponent("Cancelar", "outline", null, type: "button"); ?>
            <?= ButtonComponent("Salvar", "default", null, type: "submit"); ?>
        </div>
        </form>
    </div>
    <?php 
        if($errors) {
            echo "
                <script>
                    alert('Existem erros no formulário, por favor verifique os campos!');
                </script>
            ";
        }
    ?>
</div>
</html>
<script>
    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('imageUpload').click();
    });

    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('deleteButton').addEventListener('click', function() {
        document.getElementById('profileImage').src = '/VHS/public/images/foto-sem-perfil.jpg';
        document.getElementById('imageUpload').value = '';
        const input = document.createElement('input');
        const form = document.getElementById('form');
        input.type = 'hidden';
        input.name = 'delete_avatar';
        input.value = '1';
        form.appendChild(input);
    });
</script>

<script>
    function showNotification(title, subtitle) {
        const existing = document.getElementById('copy-notification');
        if (existing) existing.remove();

;
        const notification = document.getElementById('copy-notification');

        notification.querySelector('.title').textContent = title;
        notification.querySelector('.subtitle').textContent = subtitle;

        notification.classList.remove('hidden');

        requestAnimationFrame(() => {
            notification.classList.remove('opacity-0', 'translate-y-5');
            notification.classList.add('opacity-100', 'translate-y-0');
        });

        setTimeout(() => {
            notification.classList.remove('opacity-100', 'translate-y-0');
            notification.classList.add('opacity-0', 'translate-y-5');

            setTimeout(() => notification.remove(), 300);
        }, 2000);
    }
</script>