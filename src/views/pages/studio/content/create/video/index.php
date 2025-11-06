<?php

require_once __DIR__ . '/../../../../../components/header/headerComponent.php';
require_once __DIR__ . '/../../../../../components/studioSideMenu/studioSideMenuComponent.php';
require_once __DIR__ . '/../../../../../components/utils/buttonComponent.php';
require_once __DIR__ . '/../../../../../components/utils/footer.php';
require_once __DIR__ . '/../../../../../components/utils/inputComponent.php';
require_once __DIR__ . '/../../../../../components/utils/textareaComponent.php';
require_once __DIR__ . '/../../../../../components/modal/modal.component.php';
require_once __DIR__ . '/../../../../../components/utils/sweetalert.php';

use function Src\Application\Utils\showSweetAlert;
use function Src\Views\Components\Modal\ModalComponent;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\Footer;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\TextareaComponent;

$categories = $_SESSION["page_data"]["categories"] ?? [];
$success = $_SESSION["redirect_data"]["success"] ?? null;

$errors = $_SESSION["redirect_data"]["errors"] ?? null;
$fields = $_SESSION["redirect_data"]["fields"] ?? [];

if ($success) {
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

        <div class="md:block hidden">
            <?= StudioSideMenuComponent() ?>
        </div>

        <div class="relative flex flex-col gap-4 max-w-[1500px] mx-auto w-full">
            <div class="text-white flex flex-col gap-2">
                <div class="flex flex-col p-4 md:p-0">
                    <h1 class='md:text-title text-xl font-bold'>Criar conteúdo</h1>
                    <p class='md:text-paragraph text-sm text-gray-400 md:mt-2'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                    <div class="mt-4 flex gap-2 w-full flex-col md:w-96 md:flex-row">
                        <?php echo ButtonComponent(text: "Vídeo", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/create/video"); ?>
                        <?php echo ButtonComponent(text: "Fast", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/create/fast"); ?>
                        <?php echo ButtonComponent(text: "Eventos", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/create/event"); ?>
                    </div>
                </div>

                <form action="/VHS/api/v1/studio/create/video" enctype="multipart/form-data" method="post" class="md:p-0 p-4 flex flex-col gap-8 md:gap-4 md:mt-4">
                    <div id="URL">
                        <h1 class="md:text-subtitle text-lg text-white font-semibold">URL</h1>
                        <p class="md:text-paragraph text-sm text-gray-400 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <?= InputComponent(
                            type: "text",
                            placeholder: "https://youtube.com",
                            name: "url",
                            error: isset($errors["url"]),
                            errorDescription: isset($errors["url"]) ? $errors["url"] : "",
                            value: isset($fields["url"]) ? $fields["url"] : ""
                        )
                        ?>
                    </div>

                    <div id="thumb" class="flex flex-col gap-2">
                        <div>
                            <h1 class="md:text-subtitle text-lg text-white font-semibold">Thumbnail</h1>
                            <p class="md:text-paragraph text-sm text-gray-400 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                            <div class="md:mt-2 md:h-[500px] bg-background mt-4 w-full h-[300px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden -mt-8 flex-wrap">
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
                                            <p class="mb-2 text-xs md:text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique para dar upload</span> ou arraste e solte</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG</p>
                                        </div>
                                    </label>
                                    <input id="dropzone-file" type="file" class="hidden" accept="image/png, image/jpg, image/jpeg" name="thumbnail" />
                                </div>
                            </div>
                        </div>
                        <?php if (!empty($errors["thumbnail_url"])): ?>
                            <span class="text-red-500 font-medium">
                                <?= $errors["thumbnail_url"] ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div id="Title">
                        <h1 class="md:text-subtitle text-lg text-white font-semibold">Título</h1>
                        <p class="text-sm text-gray-400 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <?= InputComponent(
                            type: "text",
                            placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta",
                            name: "title",
                            error: isset($errors["title"]),
                            errorDescription: isset($errors["title"]) ? $errors["title"] : "",
                            value: isset($fields["title"]) ? $fields["title"] : ""
                        )
                        ?>
                    </div>

                    <div id="Description">
                        <h1 class="md:text-subtitle text-lg text-white font-semibold">Descrição</h1>
                        <p class="text-sm text-gray-400 mb-2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl.
                        </p>
                        <div class="">
                            <?= TextareaComponent(
                                type: "text",
                                placeholder: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.  😍😍😍",
                                height: "96",
                                multiline: true,
                                name: "description",
                                value: isset($fields["description"]) ? $fields["description"] : "",
                            ) ?>
                        </div>
                    </div>

                    <div id="Category" class="flex flex-col gap-2">
                        <div>
                            <h1 class="md:text-subtitle text-lg text-white font-semibold">Categoria</h1>
                            <p class="text-sm text-gray-400 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                            <select name="category_id"
                                class="px-3 py-1.5 outline outline-1 outline-[#666666] rounded-md placeholder-[#666666] text-zinc-200 w-full h-[45px] bg-transparent">
                                <option value="" <?= empty($fields['category_id']) ? 'selected' : null ?> class="text-black">
                                    Selecione uma categoria
                                </option>
                                <?php foreach ($categories as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>" class="text-black"
                                        <?= (isset($fields['category_id']) && $fields['category_id'] == $categoria['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($categoria['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if (!empty($errors["category_id"])): ?>
                            <span class="text-red-500 font-medium">
                                <?= $errors["category_id"] ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center items-end gap-10 my-4">
                        <div class="w-full order-2 md:order-1">
                            <?= ButtonComponent(text: "Cancelar", type: "button", variant: "outline", id: "cancel-button", width: 27.5, link: "/home", ) ?>
                        </div>
                        <div class="w-full order-1 md:order-2">
                            <?= ButtonComponent(text: "Salvar Alterações", variant: "default", id: "publish-button", width: 27.5, ) ?>
                        </div>
                    </div>
                </form>
                <?php 
                    if(isset($success)){
                      echo showSweetAlert("Vídeo criado com sucesso!", "", "success");
                    }
                    if(isset($errors)){
                        echo showSweetAlert("Falha em criar o vídeo!", "Falta de preencimento de campos", "error");
                    }
                ?>
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