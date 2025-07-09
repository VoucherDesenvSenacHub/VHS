<?php
require "../../../../components/utils/buttonComponent.php";
require "../../../../components/utils/inputComponent.php";
require "../../../../components/utils/textareaComponent.php";
require "../../../../components/header/headerComponent.php";
require "../../../../components/studioSideMenu/studioSideMenuComponent.php";
require "../../../../components/utils/Title_and_buttons.php";
require "../../../../components/utils/footer.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\TextareaComponent;
use function Src\views\components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\utils\Title_and_buttons;
use function src\views\components\utils\Footer;

$botoes = [
    ['texto' => 'Edição', 'link' => ''],
    ['texto' => 'Comentários', 'link' => '../components/teste.php'],
    ['texto' => 'Analytics', 'link' => '']
];

$conteudos = []
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Edicao de Vídeo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body class="">

    <div>
        <?= HeaderComponent() ?>
    </div>
    <div class="flex w-full ">

        <div class="">
            <?= StudioSideMenuComponent() ?>
        </div>
        
        <div class="flex flex-col gap-4 max-w-[1500px] w-full mx-auto">
            <div class="text-white flex flex-col gap-2">
                <div>
                    <h1 class="font-semibold text-title text-white">Edicao de video</h1>
                    <p class="text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
                </div>
                <div class="flex gap-4 w-96 mb-12 mt-4">
                    <?php
                        echo ButtonComponent("Edição", "studio", "", 10.675, 2.5,"",'/VHS/src/views/pages/studio/content/video');
                        echo ButtonComponent("Comentários", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/studio/content/video/comments.php");
                        echo ButtonComponent("Analytics", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/studio/content/video/analytics.php");
                    ?>
                </div>  
                
                <div class="w-full h-full md:h-[400px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden -mt-8 flex-wrap">
                    
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
        <div id="Title">
            <h1 class="text-3xl text-white font-semibold mt-4">Título</h1>
            <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
            <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta") ?>
        </div>
        <div id="Description">
            <h1 class="text-3xl text-white font-semibold mt-4">Descrição</h1>
            <p class="text-paragraph text-gray-400 p-0 mb-2">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl.
            </p>
            <div class="">
                <?= TextareaComponent(type: "text", 
            placeholder: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.  😍😍😍", height:"96", multiline: true
            ) ?>    
            </div>
        </div>
        <div id="Public">
            <h1 class="text-3xl text-white font-semibold mt-4">Público</h1>
            <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
            <?= InputComponent(type: "text", placeholder: "Estudante de Nível Técnico de tecnologia, Entusiasta em foguetes") ?>
        </div>
        
        <div class="flex justify-center items-end gap-10 my-6">
            <?= ButtonComponent("Salvar Alterações", "default", null, 30) ?>
            <?= ButtonComponent(text: "Cancelar", variant: "outline", id: "cancel-button", width:30) ?>
        </div>
    </div>
</div>
</div>

<footer class=""> <?= Footer()?> </footer>

<script src="./videofast.js"></script>

</body>
</html>
