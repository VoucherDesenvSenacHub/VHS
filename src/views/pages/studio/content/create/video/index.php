<?php

require_once __DIR__ . '/../../../../../components/header/headerComponent.php';
require_once __DIR__ . '/../../../../../components/studioSideMenu/studioSideMenuComponent.php';
require_once __DIR__ . '/../../../../../components/utils/buttonComponent.php';
require_once __DIR__ . '/../../../../../components/utils/inputComponent.php';
require_once __DIR__ . '/../../../../../components/utils/textareaComponent.php';
require_once __DIR__ . '/../../../../../components/utils/sweetalert.php';

use function Src\Application\Utils\showSweetAlert;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\TextareaComponent;

$categories = $_SESSION["page_data"]["categories"] ?? [];
$success = $_SESSION["redirect_data"]["success"] ?? null;
$errors = $_SESSION["redirect_data"]["errors"] ?? null;
$fields = $_SESSION["redirect_data"]["fields"] ?? [];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Criar Vídeo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
    <?= HeaderComponent(); ?>

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>

        <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white">Criar Conteúdo</h1>
                <p class="text-gray-400 mt-1">Publique um novo vídeo para o seu canal</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 mb-8 items-center justify-between">
                <div class="flex p-1 bg-[#121214] border border-white/5 rounded-xl w-full lg:w-auto">
                    <a href="/VHS/studio/create/video" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium bg-purple-600 text-white shadow-lg transition-all">
                        Vídeo
                    </a>
                    <a href="/VHS/studio/create/fast" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                        Shorts
                    </a>
                </div>
            </div>

            <form action="/VHS/api/v1/studio/create/video" enctype="multipart/form-data" method="post" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <input type="hidden" name="timezone" id="timezone">

                <div class="lg:col-span-2 space-y-6">
                    <!-- URL Section -->
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Link do Vídeo</h2>
                        <?= InputComponent(
                            type: "text",
                            placeholder: "https://youtube.com/watch?v=...",
                            name: "url",
                            error: isset($errors["url"]),
                            errorDescription: isset($errors["url"]) ? $errors["url"] : "",
                            value: isset($fields["url"]) ? $fields["url"] : ""
                        ) ?>
                    </div>

                    <!-- Details Section -->
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 space-y-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Detalhes</h2>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Título</label>
                            <?= InputComponent(
                                type: "text",
                                placeholder: "Dê um título chamativo ao seu vídeo",
                                name: "title",
                                error: isset($errors["title"]),
                                errorDescription: isset($errors["title"]) ? $errors["title"] : "",
                                value: isset($fields["title"]) ? $fields["title"] : ""
                            ) ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Descrição</label>
                            <?= TextareaComponent(
                                type: "text",
                                placeholder: "Conte aos espectadores sobre o que é seu vídeo...",
                                height: "40",
                                multiline: true,
                                name: "description",
                                value: isset($fields["description"]) ? $fields["description"] : "",
                            ) ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Categoria</label>
                            <div class="relative">
                                <select name="category_id" class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-colors appearance-none cursor-pointer">
                                    <option value="" disabled <?= empty($fields['category_id']) ? 'selected' : null ?> class="text-gray-500">Selecione uma categoria</option>
                                    <?php foreach ($categories as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>" <?= (isset($fields['category_id']) && $fields['category_id'] == $categoria['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($categoria['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <?php if (!empty($errors["category_id"])): ?>
                                <p class="text-red-500 text-xs mt-1"><?= $errors["category_id"] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Thumbnail & Actions -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-white mb-4">Thumbnail</h2>

                        <div class="relative w-full aspect-video rounded-xl border-2 border-dashed border-white/10 hover:border-purple-500/50 transition-colors overflow-hidden group bg-[#050505]">
                            <input type="file" name="thumbnail" id="dropzone-file" accept="image/png, image/jpg, image/jpeg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                            <div id="uploadText" class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center">
                                <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-400 font-medium">Clique ou arraste uma imagem</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG ou JPEG</p>
                            </div>

                            <div id="preview" class="hidden absolute inset-0 w-full h-full bg-[#050505]">
                                <img id="thumbnailPreview" class="w-full h-full object-cover" alt="Preview">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">Alterar imagem</span>
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($errors["thumbnail_url"])): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $errors["thumbnail_url"] ?></p>
                        <?php endif; ?>

                        <div class="mt-8 flex flex-col gap-3">
                            <?= ButtonComponent(text: "Publicar Vídeo", variant: "default", type: "submit", className: "w-full") ?>
                            <?= ButtonComponent(text: "Cancelar", variant: "outline", type: "button", link: "/VHS/studio/content/video", className: "w-full") ?>
                        </div>
                    </div>
                </div>
            </form>

        </main>
    </div>

    <?php
    if (isset($success)) {
        echo showSweetAlert("Vídeo criado com sucesso!", "", "success");
    }
    if (isset($errors) && is_string($errors)) { // Check if errors is a string for SweetAlert
        echo showSweetAlert("Falha ao criar o vídeo!", "Verifique os campos e tente novamente.", "error");
    }
    ?>

    <script>
        document.getElementById('timezone').value = Intl.DateTimeFormat().resolvedOptions().timeZone;

        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById('dropzone-file');

            if (fileInput) {
                fileInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const previewImg = document.getElementById('thumbnailPreview');
                            const previewDiv = document.getElementById('preview');
                            const uploadText = document.getElementById('uploadText');

                            previewImg.src = e.target.result;
                            previewDiv.classList.remove('hidden');
                            uploadText.classList.add('hidden');
                        };

                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
</body>
<?php unset($_SESSION["redirect_data"]); ?>

</html>