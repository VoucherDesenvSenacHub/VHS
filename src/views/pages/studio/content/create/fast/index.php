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

if (!empty($errors)) {
    if (str_contains(strtolower($errors), 'titulo')) {
        $titleError = $errors;
    }
    if (str_contains(strtolower($errors), 'vídeo')) {
        $videoError = $errors;
    } else {
        $genericError = $errors;
    }
}
unset($_SESSION['redirect_data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Vídeo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>
<?php echo ButtonComponent("Fast", "studio", "", 10.675, 2.5, "", "/VHS/studio/create/fast"); ?>
<?php echo ButtonComponent("Eventos", "studio", "", 10.675, 2.5, "", "/VHS/studio/create/event"); ?>
</div>
<form id="uploadForm" action="/VHS/api/v1/fast-video" method="POST" enctype="multipart/form-data">
    <div id="URL">
        <text class="md:text-subtitle text-lg text-white font-semibold py-4">Título do Fast</text>
        <?= InputComponent(type: "text", placeholder: "https://youtube.com", name: "title", value: $fields ?? "", error: !empty($titleError), errorDescription: !empty($titleError) ? $titleError : "") ?>
    </div>
    <div class="mt-4 mb-2" id="thumb">
        <text class="md:text-subtitle text-lg text-white font-semibold py-4">Upload de vídeo</text>
    </div>
    <div class="flex flex-col mb-[3rem]mt-2 md:px-0">
        <div class="bg-background w-full h-[600px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden md:w-[300px] md:h-[600px] <?= isset($vídeoError) ? "border-red-500" : "border-[#666666]" ?>">
            <video id="videoPreview" class="hidden w-full h-full object-cover rounded-lg absolute" controls></video>
            <div id="uploadArea" class="flex flex-col items-center justify-center w-full h-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer bg-background hover:bg-gray-800">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <img class="mb-3" src="/VHS/public/icons/Upload.svg" alt="upload icon">
                        <p class="mb-1 text-sm text-gray-400">Selecione arquivos</p>
                        <p class="text-sm text-gray-400">Ou arraste aqui</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" accept="video/mp4,video/webm,video/ogg" name="video" />
                </label>
            </div>
        </div>
        <?php
        if (isset($videoError)) {
            echo '<div class="text-red-500 text-sm mt-2">' . $videoError . '</div>';
        }
        ?>
    </div>
    <input type="hidden" name="thumbnail" id="thumbnailData">
    <div class="flex flex-col sm:flex-row justify-center items-end gap-10 my-4">
        <?= ButtonComponent(text: "Cancelar", variant: "outline") ?>
        <?= ButtonComponent(text: "Publicar", variant: "default") ?>
    </div>
</form>
</div>
</div>
<div>
    <?php echo isset($success) ? showSweetAlert('Conteúdo criado com sucesso!', $success, 'success') : ''; ?>
</div>
<script>
    const videoInput = document.getElementById('dropzone-file');
    const videoPreview = document.getElementById('videoPreview');
    const uploadArea = document.getElementById('uploadArea');
    const thumbnailData = document.getElementById('thumbnailData');
    const form = document.getElementById('uploadForm');
    const canvas = document.createElement('canvas');

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

    videoPreview.addEventListener('seeked', () => {
        const ctx = canvas.getContext('2d');
        canvas.width = videoPreview.videoWidth;
        canvas.height = videoPreview.videoHeight;
        ctx.drawImage(videoPreview, 0, 0, canvas.width, canvas.height);
        thumbnailData.value = canvas.toDataURL('image/jpeg', 1.0);
    });

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('bg-gray-800');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('bg-gray-800');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('bg-gray-800');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('video/')) {
            videoInput.files = e.dataTransfer.files;
            const url = URL.createObjectURL(file);
            videoPreview.src = url;
            videoPreview.classList.remove('hidden');
            uploadArea.classList.add('hidden');
            videoPreview.currentTime = 1;
        }
    });
</script>
</body>

</html>