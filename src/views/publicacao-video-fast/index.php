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
    <div class="flex flex-row w-full">

        <div>
            <?= StudioSideMenuComponent() ?>
        </div>

        <div class="flex flex-col gap-4 w-1/2">
            <div class="text-white flex flex-col gap-2">
                <h1 class='text-title font-bold'>Criar conteúdo</h1>
                <h1 class='text-paragraph text-gray-400'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</h1>
                <div class="mt-2 flex gap-2">
                    <?php echo ButtonComponent("Vídeo", "studio", "", 10.675, 2.5, "", "../publicacao-video-longo/index.php"); ?>
                    <?php echo ButtonComponent("Fast", "studio", "", 10.675, 2.5, "", "#"); ?>
                    <?php echo ButtonComponent("Eventos", "studio", "", 10.675, 2.5, "", "../publicacao-video-evento/index.php"); ?>
                </div>

                <div id="URL">
                    <h1 class="text-subtitle text-white font-semibold mt-4">Título do Fast</h1>
                    <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                    <?= InputComponent(type: "text", placeholder: "https://youtube.com") ?>
                </div>

                <div id="thumb">
                    <h1 class="text-subtitle text-white font-semibold mt-4">Upload de vídeo</h1>
                    <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
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