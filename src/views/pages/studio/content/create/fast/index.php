<?php
require_once __DIR__ . "/../../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../../components/utils/sweetalert.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\views\components\header\HeaderComponent;
use function Src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Application\Utils\showSweetAlert;

$success = $_SESSION['redirect_data']['success'] ?? null;
$errors = $_SESSION['redirect_data']['errors'] ?? null;
$fields = $_SESSION['redirect_data']['fields'] ?? null;

$titleError = null;
$videoError = null;
$genericError = null;

if (!empty($errors)) {
    if (is_string($errors)) {
        if (str_contains(strtolower($errors), 'titulo')) {
            $titleError = $errors;
        } elseif (str_contains(strtolower($errors), 'vídeo')) {
            $videoError = $errors;
        } else {
            $genericError = $errors;
        }
    }
}
unset($_SESSION['redirect_data']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Criar Short</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
    <?= HeaderComponent(); ?>

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>
        <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white">Criar Conteúdo</h1>
                <p class="text-gray-400 mt-1">Publique um novo vídeo curto para o seu canal</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 mb-8 items-center justify-between">
                <div class="flex p-1 bg-[#121214] border border-white/5 rounded-xl w-full lg:w-auto">
                    <a href="/VHS/studio/create/video" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all text-center">
                        Vídeo
                    </a>
                    <a href="/VHS/studio/create/fast" class="flex-1 lg:flex-none px-8 py-2.5 rounded-lg text-sm font-medium bg-purple-600 text-white shadow-lg transition-all text-center">
                        Shorts
                    </a>
                </div>
            </div>

            <form id="uploadForm" action="/VHS/api/v1/fast-video" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column: Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Detalhes do Short</h2>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Título</label>
                            <?= InputComponent(
                                type: "text",
                                placeholder: "Dê um título curto e chamativo",
                                name: "title",
                                value: $fields['title'] ?? "",
                                error: !empty($titleError),
                                errorDescription: !empty($titleError) ? $titleError : ""
                            ) ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Video Upload -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-white mb-4">Upload de Vídeo</h2>

                        <div class="relative w-full aspect-[9/16] rounded-xl border-2 border-dashed border-white/10 hover:border-purple-500/50 transition-colors overflow-hidden group bg-[#050505] <?= isset($videoError) ? "border-red-500" : "" ?>">
                            <input id="dropzone-file" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="video/mp4,video/webm,video/ogg" name="video" />

                            <video id="videoPreview" class="hidden w-full h-full object-cover" controls></video>

                            <div id="uploadArea" class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center pointer-events-none">
                                <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-400 font-medium">Clique ou arraste o vídeo</p>
                                <p class="text-xs text-gray-500 mt-1">MP4, WebM ou OGG</p>
                                <p class="text-xs text-gray-600 mt-4">Formato Vertical (9:16)</p>
                            </div>
                        </div>
                        <?php if (isset($videoError)): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $videoError ?></p>
                        <?php endif; ?>

                        <input type="hidden" name="thumbnail" id="thumbnailData">

                        <div class="mt-8 flex flex-col gap-3">
                            <?= ButtonComponent(text: "Publicar Short", variant: "default", type: "submit", className: "w-full") ?>
                            <?= ButtonComponent(text: "Cancelar", variant: "outline", type: "button", link: "/VHS/studio/content/fast", className: "w-full") ?>
                        </div>
                    </div>
                </div>
            </form>

        </main>
    </div>

    <?php echo isset($success) ? showSweetAlert('Conteúdo criado com sucesso!', $success, 'success') : ''; ?>
    <?php echo isset($genericError) ? showSweetAlert('Erro ao criar conteúdo', $genericError, 'error') : ''; ?>

    <script>
        const videoInput = document.getElementById('dropzone-file');
        const videoPreview = document.getElementById('videoPreview');
        const uploadArea = document.getElementById('uploadArea');
        const thumbnailData = document.getElementById('thumbnailData');
        const form = document.getElementById('uploadForm');
        const canvas = document.createElement('canvas');

        if (videoInput) {
            videoInput.addEventListener('change', () => {
                const file = videoInput.files[0];
                if (file) {
                    const url = URL.createObjectURL(file);
                    videoPreview.src = url;
                    videoPreview.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                    videoPreview.currentTime = 1;
                }
            });
        }

        if (videoPreview) {
            videoPreview.addEventListener('seeked', () => {
                const ctx = canvas.getContext('2d');
                canvas.width = videoPreview.videoWidth;
                canvas.height = videoPreview.videoHeight;
                ctx.drawImage(videoPreview, 0, 0, canvas.width, canvas.height);
                thumbnailData.value = canvas.toDataURL('image/jpeg', 1.0);
            });
        }

        // Drag and drop visual feedback
        const dropZone = document.querySelector('.group');

        if (dropZone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.add('bg-white/5');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('bg-white/5');
                }, false);
            });
        }
    </script>
</body>

</html>