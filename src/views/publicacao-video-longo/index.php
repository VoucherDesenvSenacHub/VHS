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


$botoes =[
    ['texto' => 'Video', 'link' => ''],
    ['texto' => 'Fast', 'link' => '../../fast.php'],
    ['texto' => 'Eventos', 'link' => 'link 3']
];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conteúdo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../styles/tailwindglobal.js"></script>
</head>
<body class="bg-[#0D011A] text-white font-sans overflow-x-hidden">

    
    <?= HeaderComponent() ?>
    
    <div class="">
            <?= StudioSideMenuComponent() ?>
    </div>

    <div class="justfy-center items-center"> 
        <?= Title_and_buttons ("Criar Conteúdo", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,", $botoes) ?>
    </div>
    
    <main class="px-4 md:px-16 py-10 space-y-8 w-full max-w-5xl mx-auto">
        <section>
       
            <div class="mb-8">
                <p class="text-2xl font-bold text-white mb-2">URL</p>
                <?= InputComponent(type: "text", placeholder: "https://youtube.com") ?>
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white mb-2">Thumbnail</h1>
                <p class="text-sm text-gray-300 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>

                <div class="bg-background w-full h-64 md:h-96 border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden">
                    <video id="videoPreview" class="hidden w-full h-full object-cover rounded-lg absolute" controls></video>

                    <div id="uploadArea" class="flex flex-col items-center justify-center w-full h-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique para enviar</span> ou arraste e solte</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">MP4, WebM, Ogg (MÁX. 50MB)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept="video/mp4,video/webm,video/ogg" />
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white mb-2">Título</h1>
                <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta") ?>
            </div>

            <div class="mb-8">
                <p class="text-2xl font-bold text-white mb-2">Descrição</p>
                <textarea class="w-full bg-[#1A0F2C] border border-gray-600 rounded-lg p-4 text-sm text-white placeholder:text-gray-500 resize-none h-36" placeholder="Digite a descrição..."></textarea>
            </div>

            <div class="mb-8">
                <p class="text-2xl font-bold text-white mb-2">Público</p>
                <?= InputComponent(type: "text", placeholder: "Estudante de Nível Técnico de tecnologia, Entusiasta de foguetes") ?>
            </div>

            <div class="flex flex-col md:flex-row justify-center items-center md:items-end gap-4 mt-10">
                <?= ButtonComponent("Cancelar", "outline", null, "380px", "50px", null, "#") ?>
                <?= ButtonComponent("Publicar", "default", null, "380px", "50px", null, "#") ?>
            </div>

        </section>
    </main>

    <script src="./videolongo.js"></script>

</body>
</html>
