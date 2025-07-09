<?php
require __DIR__ . '/../../components/utils/buttonComponent.php';
require __DIR__ . '/../../components/utils/inputComponent.php';
require __DIR__ . '/../../components/header/headerComponent.php';
<<<<<<< HEAD
require __DIR__ . '/../../components/barra_lateral/SidebarComponent.php';
=======
require __DIR__ . '/../../components/sidebar/barra_lateral.php';
require __DIR__ . '/../../components/Shared/shared.php';
>>>>>>> origin/feat/Events-Page

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\views\Components\sidebar\SidebarComponent;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>

<body class="bg-background flex">
    <div class="fixed w-screen">
        <?= HeaderComponent() ?>
    </div>
    <div class="flex mt-20">
        <?= SidebarComponent() ?>
    </div>
    <div class="flex ml-24 mt-14 w-full">
        <div class="flex flex-col gap-4 p-6 flex-grow">
            <p class="font-sans font-semibold text-3xl text-gray-200 mb-2">Gerenciar Perfil</p>
            <div class="w-[550px] flex flex-col gap-8">
                <div class="flex items-center justify-between gap-2 w-full">
                    <div class="w-36 h-36 relative flex  shrink-0 overflow-hidden rounded-full">
                        <img id="profileImage" src="/VHS/public/images/foto-sem-perfil.jpg" alt="Imagem de Perfil" class="object-cover w-full h-full">
                    </div>
                    <div class="flex space-x-3 w-96">
                        <button id="uploadButton" class="bg-purple-700 transition-colors hover:bg-purple-800 text-white rounded flex justify-center items-center w-full h-[50px] gap-2 rounded-md cursor-pointer ">Carregar foto</button>
                        <button id="deleteButton" class="flex justify-center items-center w-full h-[50px] gap-2 rounded-md cursor-pointer outline outline-1 outline-purple-500 text-white">Excluir</button>
                    </div>
                    <input type="file" id="imageUpload" accept="image/*" class="hidden">
                </div>
                <div class="flex flex-col gap-6">
                    <?= InputComponent(
                        placeholder: "@UsuárioSenac12333",
                        type: "text",
                        label: "Nome de Usuário",
                        icon: "/VHS/public/icons/userRound.svg",
                        iconPosition: "right-3"
                    ) ?>
                    <?= InputComponent(
                        placeholder: "Usuário123@gmail.com",
                        type: "email",
                        label: "E-mail",
                        icon: "/VHS/public/icons/mail.svg",
                        iconPosition: "right-3"
                    ) ?>
                    <?= InputComponent(
                        placeholder: "Senha123",
                        type: "password",
                        label: "Senha",
                        icon: "/VHS/public/icons/lock.svg",
                        iconPosition: "right-3"
                    ) ?>
                    <?= InputComponent(
                        placeholder: "Inovações de Tecnologias",
                        type: "text",
                        label: "Categorias de Interesse",
                        iconPosition: "right-3"
                    ) ?>
                </div>
                <div class="flex items-center justify-between w-full ">
                    <?= ButtonComponent("Cancelar", "outline", null, 240, 50,); ?>

                    <button onclick="showNotification('Sucesso!', 'As alterações foram salvas.')" class="bg-purple-700 hover:bg-purple-800 text-white w-[250px] h-[55px] rounded-md">
                        Salvar Alterações
                    </button>

                </div>
            </div>
        </div>
    </div>
</body>

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
    });
</script>

<script>
    function showNotification(title, subtitle) {
        const existing = document.getElementById('copy-notification');
        if (existing) existing.remove();

        document.body.insertAdjacentHTML('beforeend', `<?= copyNotify(); ?>`);
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