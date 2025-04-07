<?php
require "../components/utils/buttonComponent.php";
require "../components/utils/inputComponent.php";
require "../components/header/headerComponent.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\views\components\header\HeaderComponent;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Vídeo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../styles/tailwindglobal.js"></script>
</head>

<body class="w-screen h-screen bg-background">

    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col gap-4 w-1/2 ml-60">
        <div class="text-white flex flex-col gap-2">
            <h1 class="text-title">Título do Fast</h1>
            <p class="text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
        </div>

        <div>
            <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta") ?>
        </div>

        <div class="text-white flex flex-col gap-2">
            <h1 class="text-title">Upload do Vídeo</h1>
            <p class="text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
        </div>

        <div class="bg-background w-[950px] h-[400px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden">
           
            <video id="videoPreview" class="hidden w-full h-full object-cover rounded-lg absolute" controls></video>

            <div id="uploadArea" class="flex flex-col items-center justify-center w-full h-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> ou arraste e solte</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">MP4, WebM, Ogg (MAX. 50MB)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" accept="video/mp4,video/webm,video/ogg" />
                </label>
            </div>
        </div>

        <div class="flex justify-center items-end gap-10">
            <?= ButtonComponent(text: "Cancelar", variant: "outline", id: "cancel-button") ?>
            <?= ButtonComponent(text: "Publicar", variant: "default", id: "publish-button") ?>
        </div>
    </div>

    <script src="./videofast.js"></script>

</body>
</html>
