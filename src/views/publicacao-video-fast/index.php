<?php
require "../components/utils/buttonComponent.php";
require "../components/utils/Title_and_buttons.php";
require "../components/utils/inputComponent.php";
require "../components/header/headerComponent.php";
require "../components/studioSideMenu/studioSideMenuComponent.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function src\views\components\utils\Title_and_buttons;
use function Src\Views\Components\Utils\InputComponent;
use function Src\views\components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;

$botoes = [
    ['texto' => 'Video', 'link' => '../../publicacao-video-longo/index.php'],
    ['texto' => 'Fast', 'link' => '../../publicacao-fast/index.php'],
    ['texto' => 'Eventos', 'link' => 'link 3']
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Vídeo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../styles/tailwindglobal.js"></script>
</head>

<body class="bg-[#0D011A] text-white font-sans overflow-x-hidden">

    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex">
   
        <div>
            <?= StudioSideMenuComponent() ?>
        </div>
        
        <div class="w-full">
        
            <div class="px-4 md:px-10">
                <?= Title_and_buttons("Criar Conteúdo", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,", $botoes) ?>
            </div>

            <main class="px-4 md:px-10 py-10 space-y-8 w-full max-w-6xl">
                <section>
                    <div class="text-white flex flex-col gap-2 mb-8">
                        <h1 class="text-2xl font-bold text-white mb-2">Título do Fast</h1>
                        <p class="text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta") ?>
                    </div>

                    <div class="text-white flex flex-col gap-2 mb-8">
                        <h1 class="text-2xl font-bold text-white mb-2">Upload do Vídeo</h1>
                        <p class="text-paragraph">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>

                        <div class="bg-background w-full h-64 md:h-96 border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden">
                            <video id="videoPreview" class="hidden w-full h-full object-cover rounded-lg absolute" controls></video>

                            <div id="uploadArea" class="flex flex-col items-center justify-center w-full h-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> ou arraste e solte</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">MP4, WebM, Ogg (MAX. 50MB)</p>
                                    </div>
                                    <input id="dropzone-file" type="file" class="hidden" accept="video/mp4,video/webm,video/ogg" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-center items-center md:items-end gap-4 mt-10">
                        <?= ButtonComponent("Cancelar", "outline", null, "380px", "50px", "cancel-button", "#") ?>
                        <?= ButtonComponent("Publicar", "default", null, "380px", "50px", null, "#") ?>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script src="./videofast.js"></script>
</body>

</html>
