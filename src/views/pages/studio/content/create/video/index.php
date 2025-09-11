<?php

require_once __DIR__ . '/../../../../../components/header/headerComponent.php';
require_once __DIR__ . '/../../../../../components/studioSideMenu/studioSideMenuComponent.php';
require_once __DIR__ . '/../../../../../components/utils/buttonComponent.php';
require_once __DIR__ . '/../../../../../components/utils/footer.php';
require_once __DIR__ . '/../../../../../components/utils/inputComponent.php';
require_once __DIR__ . '/../../../../../components/utils/textareaComponent.php';
require_once __DIR__ . '/../../../../../components/modal/modal.component.php';

use function Src\Views\Components\Modal\ModalComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\Footer;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\TextareaComponent;


$categorias = $_SESSION["page_data"]["categorias"] ?? [];

$modal = $_SESSION["redirect_data"]["success"] ?? false;

if($modal){
    unset($_SESSION["redirect_data"]);  
    echo ModalComponent("Criado com sucesso!", "Deseja continuar criando vídeos?");
}

$botoes = [
    ['texto' => 'Edição', 'link' => ''],
    ['texto' => 'Comentários', 'link' => '../components/teste.php'],
    ['texto' => 'Analytics', 'link' => '']
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Criar video</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>

<body> 
    <div>
        <?= HeaderComponent() ?>
    </div>
    <div class="flex flex-row w-full">
        
        <div>
            <?= StudioSideMenuComponent() ?>
        </div>
        
        <div class=" relative flex flex-col gap-4 max-w-[1500px] mx-auto w-full">
            <div class="text-white flex flex-col gap-2">
                <h1 class='text-title font-bold'>Criar conteúdo</h1>
                <h1 class='text-paragraph text-gray-400'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</h1>
                <div class="mt-2 flex gap-2 w-96">
                    <?php echo ButtonComponent("Vídeo", "studio", "", 10.675, 2.5, "", "/VHS/create/video"); ?>
                    <?php echo ButtonComponent("Fast", "studio", "", 10.675, 2.5, "", "/VHS/create/fast"); ?>
                    <?php echo ButtonComponent("Eventos", "studio", "", 10.675, 2.5, "", "/VHS/create/event"); ?>
                </div>

                <form action="/VHS/src/application/routes/route.php/api/v1/studio/create/video" enctype="multipart/form-data" method="post">
                    <div id="URL">
                        <h1 class="text-subtitle text-white font-semibold mt-4">URL</h1>
                        <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <?= InputComponent(type: "text", placeholder: "https://youtube.com", name: "url", required: true) ?>
                    </div>

                    <div id="thumb">
                        <h1 class="text-subtitle text-white font-semibold mt-4">Thumbnail</h1>
                        <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <div class="mt-2 bg-background w-full h-full md:h-[500px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden -mt-8 flex-wrap">
                            <div id="uploadArea" class="flex flex-col items-center justify-center w-full h-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">

                                    <div id="preview" class="hidden w-full h-full">
                                        <img id="thumbnailPreview" class="object-cover w-full h-full rounded-lg" alt="Preview" />
                                    </div>

                                    <div id="uploadText" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> ou arraste e solte</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG</p>
                                    </div>

                                    <input id="dropzone-file" type="file" class="hidden" accept="image/png, image/jpg, image/jpeg" name="thumbnail" required/>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div id="Title">
                        <h1 class="text-3xl text-white font-semibold mt-4">Título</h1>
                        <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta", name: "title", required: true) ?>
                    </div>
                    <div id="Description">
                        <h1 class="text-3xl text-white font-semibold mt-4">Descrição</h1>
                        <p class="text-paragraph text-gray-400 p-0 mb-2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl.
                        </p>
                        <div class="">
                            <?= TextareaComponent(
                                type: "text",
                                placeholder: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.  😍😍😍",
                                height: "96",
                                multiline: true,
                                name: "description",
                                required: true
                            ) ?>
                        </div>
                    </div>
                    <!-- <div id="Public">
                        <h1 class="text-3xl text-white font-semibold mt-4">Público</h1>
                        <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta", name: "title", required: true) ?>
                    </div> -->
                    
                    <div id="Category">
                        <h1 class="text-3xl text-white font-semibold mt-4">Categoria</h1>
                        <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <select name="category_id" class="px-3 py-1.5 outline outline-1 outline-[#666666] rounded-md placeholder-[#666666] text-zinc-200 w-full h-[45px] bg-transparent">
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>" class="text-black">
                                    <?= htmlspecialchars($categoria['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center items-end gap-10 my-6">
                        <?= ButtonComponent(text: "Cancelar", variant: "outline", id: "cancel-button", width: 27.5, link: "/home") ?>
                        <?= ButtonComponent(text: "Salvar Alterações", variant: "default", id: "publish-button", width: 27.5) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class=""> <?= Footer() ?> </footer>

    <script>
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
                            previewDiv.classList.remove('hidden'); // mostra preview
                            uploadText.classList.add('hidden'); // esconde texto
                        };

                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>

</body>

</html>