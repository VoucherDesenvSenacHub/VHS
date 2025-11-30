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

$user = $_SESSION["user"];
$userCategories = $_SESSION["page_data"]["user_categories"];
$categories = $_SESSION["page_data"]["categories"] ?? [];
$errors = $_SESSION["redirect_data"]["errors"] ?? [];
$avatar_url = !empty($user['avatar_url']) ? $user['avatar_url'] : 'default.png';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Minha Conta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="/VHS/src/views/pages/user/settings/script.js" defer></script>
    <style>
        /* .bg-[#121214] border border-white/5 {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        } */

        .category-btn.active {
            background-color: rgb(107 33 168);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 15px rgba(168, 85, 247, 0.4);
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#100018] to-black w-full min-h-screen text-white flex flex-col overflow-x-hidden">

    <script>
        var categories = [];
        var userCategories = [];

        <?php foreach ($categories as $category): ?>
            categories.push("<?= $category["name"] ?? "" ?>");
        <?php endforeach; ?>

        <?php foreach ($userCategories as $category): ?>
            userCategories.push("<?= $category["name"] ?? "" ?>");
        <?php endforeach; ?>
    </script>

    <?= HeaderComponent() ?>

    <div class="flex flex-1">
        <div class="hidden md:block h-full z-40">
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 p-6 w-full max-w-[1600px] mx-auto">

            <!-- Header Section -->
            <div class="mb-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                        Gerenciar Perfil
                    </h1>
                    <p class="text-gray-400 mt-2">Atualize suas informações pessoais e preferências</p>
                </div>
            </div>

            <form method="post" action="/VHS/api/v1/user/settings" enctype="multipart/form-data" id="form" class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column: Avatar & Basic Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Avatar Card -->
                    <div class="bg-[#121214] border border-white/5 rounded-3xl p-8 flex flex-col items-center text-center relative overflow-hidden group">
                        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-purple-900/20 to-transparent"></div>

                        <div class="relative w-40 h-40 mb-6">
                            <div class="w-full h-full rounded-full p-1 bg-gradient-to-tr from-purple-500 to-pink-500">
                                <img id="profileImage" src="/VHS/public/uploads/avatars/<?= $avatar_url ?>" onerror="this.src='/VHS/public/uploads/avatars/default.png'" class="w-full h-full rounded-full object-cover border-4 border-[#121214]">
                            </div>
                            <button type="button" id="uploadButton" class="absolute bottom-2 right-2 p-3 bg-purple-600 hover:bg-purple-700 rounded-full text-white shadow-lg transition-all transform hover:scale-110 group-hover:rotate-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-1"><?= htmlspecialchars($user['name']) ?></h3>
                        <p class="text-purple-400 text-sm mb-6">@<?= htmlspecialchars($user['username']) ?></p>

                        <div class="flex gap-3 w-full">
                            <button type="button" id="deleteButton" class="flex-1 py-2.5 px-4 rounded-xl border border-red-500/30 text-red-400 hover:bg-red-500/10 transition-colors text-sm font-medium">
                                Remover Foto
                            </button>
                        </div>

                        <input type="file" name="avatar" id="imageUpload" accept="image/*" class="hidden">
                    </div>

                    <!-- Quick Stats or Info (Optional decoration) -->
                    <div class="bg-[#121214] border border-white/5 rounded-3xl p-6">
                        <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Status da Conta</h4>
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-gray-300">Ativa</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            Membro desde <?= date('Y') // Placeholder 
                                            ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form Fields -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Personal Info -->
                    <div class="bg-[#121214] border border-white/5 rounded-3xl p-8">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informações Pessoais
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?= InputComponent(
                                placeholder: "Seu nome completo",
                                name: "name",
                                type: "text",
                                label: "Nome de Exibição",
                                value: $user["name"],
                            ) ?>

                            <?= InputComponent(
                                placeholder: "seu.usuario",
                                name: "username",
                                type: "text",
                                label: "Nome de Usuário",
                                value: $user["username"],
                                error: $errors["username"] ?? "",
                                errorDescription: $errors["username"] ?? "",
                            ) ?>

                            <div class="md:col-span-2">
                                <?= InputComponent(
                                    placeholder: "exemplo@email.com",
                                    name: "email",
                                    type: "email",
                                    label: "Endereço de E-mail",
                                    value: $user["email"],
                                    error: isset($errors["email"]) ? true : "",
                                    errorDescription: $errors["email"] ?? "",
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <!-- Security -->
                    <div class="bg-[#121214] border border-white/5 rounded-3xl p-8">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Segurança
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?= InputComponent(
                                placeholder: "••••••••",
                                name: "password",
                                type: "password",
                                label: "Senha Atual",
                            ) ?>

                            <?= InputComponent(
                                placeholder: "••••••••",
                                name: "new_password",
                                type: "password",
                                label: "Nova Senha",
                            ) ?>
                        </div>
                    </div>

                    <!-- Interests -->
                    <div class="bg-[#121214] border border-white/5 rounded-3xl p-8">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Seus Interesses
                        </h3>

                        <p class="text-gray-400 text-sm mb-4">Selecione as categorias que você mais gosta para personalizarmos sua experiência.</p>

                        <div id="categoryButtons" class="flex flex-wrap gap-3">
                            <?php foreach ($categories as $category): ?>
                                <button type="button"
                                    class="category-btn px-5 py-2.5 rounded-full border border-white/10 bg-white/5 text-gray-300 hover:bg-white/10 hover:border-white/20 transition-all duration-300 text-sm font-medium"
                                    data-id="<?= $category['id'] ?>">
                                    <?= $category['name'] ?>
                                </button>
                            <?php endforeach; ?>
                            <input type="text" hidden name="categories[]" id="categoriesInput">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-center gap-4 pt-4">
                        <?= ButtonComponent("Cancelar", "outline", null, link: "/VHS/home", type: "button", className: "w-full md:w-auto px-8") ?>
                        <?= ButtonComponent("Salvar Alterações", "default", null, type: "submit", className: "w-full md:w-auto px-8") ?>
                    </div>

                </div>
            </form>
        </main>
    </div>

    <?php
    if ($errors) {
        echo "<script>alert('Existem erros no formulário, por favor verifique os campos!');</script>";
    }
    ?>

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
            document.getElementById('profileImage').src = '/VHS/public/uploads/avatars/default.png';
            document.getElementById('imageUpload').value = '';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_avatar';
            input.value = '1';
            document.getElementById('form').appendChild(input);
        };
    </script>
</body>

</html>