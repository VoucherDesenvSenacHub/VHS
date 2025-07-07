<?php
require "../components/utils/buttonComponent.php";
require "../components/utils/inputComponent.php";
require "../components/header/headerComponent.php";
require "../components/studioSideMenu/studioSideMenuComponent.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\views\components\header\HeaderComponent;
use function Src\views\components\studioSideMenu\StudioSideMenuComponent;
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

<body class="w-full h-full bg-background">

    <div>
        <?= HeaderComponent() ?>
    </div>
    <div class="flex">
        <?= StudioSideMenuComponent() ?>
        <div class="flex flex-col gap-4 max-w-[850px] w-full">
            <div class="text-white flex flex-col gap-2">
                <h1 class="text-title">Criar conteúdo</h1>
                <p class="text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                <div class="flex gap-[0.5rem] md:gap-[1.5rem]">
                    <?= ButtonComponent(text: "Vídeo", variant: "studio", width: "10", height: "2") ?>
                    <?= ButtonComponent(text: "Fast", variant: "studio", width: "10", height: "2") ?>
                    <?= ButtonComponent(text: "Eventos", variant: "studio", width: "10", height: "2") ?>
                </div>
            </div>

            <div class="text-white flex flex-col gap-2">
                <h1 class="text-title">Título do Fast</h1>
                <p class="text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta") ?>
            </div>

            <div class="text-white flex flex-col gap-2">
                <h1 class="text-title">Upload do Vídeo</h1>
                <p class="text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex mb-[3rem]">
                <div class="bg-background w-full h-[600px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden md:w-[300px] md:h-[600px] border-[#666666]">
                    
                    <video id="videoPreview" class="hidden w-full h-full object-cover rounded-lg absolute" controls></video>

                    <div id="uploadArea" class="flex flex-col items-center justify-center w-full h-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full cursor-pointer bg-background hover:bg-gray-800">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <img class="mb-3" src="/VHS/public/icons/Upload.svg" alt="upload icon">
                                <p class="mb-1 text-sm text-gray-400">Selecione arquivos</p>
                                <p class="text-sm text-gray-400">Ou arraste aqui</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept="video/mp4,video/webm,video/ogg" />
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-[1rem] w-full md:flex-row md:gap-[5.3rem] mb-[5rem]">
                <?= ButtonComponent(text: "Cancelar", variant: "outline") ?>
                <?= ButtonComponent(text: "Publicar", variant: "default") ?>
            </div>
        </div>
    </div>

    <script src="./videofast.js"></script>

</body>
</html>
