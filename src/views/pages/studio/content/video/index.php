<?php
require_once __DIR__ . "/../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../components/utils/textareaComponent.php";
require_once __DIR__ . "/../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../components/utils/Title_and_buttons.php";
require_once __DIR__ . "/../../../../components/utils/footer.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\TextareaComponent;
use function Src\views\components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\utils\Footer;

$botoes = [
    ['texto' => 'Edição', 'link' => ''],
    ['texto' => 'Comentários', 'link' => '../components/teste.php'],
    ['texto' => 'Analytics', 'link' => '']
];

$video = $_SESSION["page_data"]["video"] ?? [];
$categorias = $_SESSION["page_data"]["categorias"] ?? [];

$thumbPath = '';
if (!empty($video) && !empty($video['thumbnail_url'])) {
    $url = $video['thumbnail_url'];

    $url = preg_replace('#^/VHS+#', '/VHS', $url);
    if (!str_starts_with($url, '/VHS')) {
        $url = '/VHS' . $url;
    }

    $thumbPath = $url;
}


$id = $video["id"];

$conteudos = []
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Edição de Vídeo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body class="">
    <div>
        <?= HeaderComponent() ?>
    </div>
    <div class="flex flex-row w-full">

        <div class="max-xl:hidden">
            <?= StudioSideMenuComponent() ?>
        </div>
        
        <div class="flex flex-col gap-4 max-w-[1500px] w-full mx-auto px-6">
            <div class="text-white flex flex-col gap-2">
                <div class="flex flex-col p-4 md:p-0">
                    <h1 class="font-semibold xl:text-title text-xl md:text-2xl text-white">Edição de video</h1>
                    <p class="text-gray-300 xl:text-paragraph text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
                    <div class="mt-4 flex gap-2 w-full flex-col md:w-96 md:flex-row">
                        <?php
                        echo ButtonComponent(text: "Edição", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/content/video/edit?id=$id");
                        echo ButtonComponent(text: "Comentários", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/content/video/comentary?id=$id");
                        echo ButtonComponent(text: "Analytics", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/content/video/analytic?id=$id");
                        ?>
                    </div>
                </div>

                <form action="/VHS/api/v1/studio/content/video/edit" enctype="multipart/form-data" method="post" class="md:p-0 p-4 flex flex-col gap-8 md:gap-4 md:mt-4">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($video["id"]) ?>">
                    <input type="hidden" name="old_thumbnail" value="<?= htmlspecialchars($video["thumbnail_url"]) ?>">

                    <div id="thumb" class="flex flex-col gap-2">
                        <h1 class="md:text-subtitle text-lg text-white font-semibold">Thumbnail</h1>
                        <p class="md:text-paragraph text-sm text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <div class="md:mt-2 md:h-[500px] bg-background mt-4 w-full h-[300px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden flex-wrap">
                            <label for="dropzone-file"
                                class="flex items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 relative overflow-hidden">

                                <img id="thumbnailPreview"
                                    src="<?= htmlspecialchars($thumbPath) ?>"
                                    class="absolute inset-0 object-cover w-full h-full rounded-lg hidden"
                                    alt="Preview" />

                                <div id="uploadText" class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Clique para dar upload</span> ou arraste e solte</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG</p>
                                </div>

                                <input id="dropzone-file" type="file" class="hidden" accept="image/png, image/jpg, image/jpeg" name="thumbnail" />
                            </label>
                        </div>
                    </div>

                    <div id="Title">
                        <h1 class="md:text-subtitle text-lg text-white font-semibold">Título</h1>
                        <p class="text-paragraph text-gray-400 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <?= InputComponent(type: "text", placeholder: "Tudo sobre o Next.js 15, nova arquitetura de pasta", value: $video["title"], name: "title") ?>
                    </div>

                    <div id="Description">
                        <h1 class="md:text-subtitle text-lg text-white font-semibold">Descrição</h1>
                        <p class="text-paragraph text-gray-400 mb-2">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl.
                        </p>
                        <div class="">
                            <?= TextareaComponent(
                                type: "text",
                                placeholder: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.t, consectetur adipiscing elit.  😍😍😍",
                                height: "96",
                                name: "description",
                                value: $video["description"]
                            ) ?>
                        </div>
                    </div>

                    <div id="Category">
                        <h1 class="md:text-subtitle text-lg text-white font-semibold">Categoria</h1>
                        <p class="text-paragraph text-gray-400 p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
                        <select name="category_id" class="px-3 py-1.5 outline outline-1 outline-[#666666] rounded-md placeholder-[#666666] text-zinc-200 w-full h-[45px] bg-transparent">
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id'] ?>"
                                    class="text-black"
                                    <?= ($video["category_id"] == $categoria['id']) ? "selected" : "" ?>>
                                    <?= htmlspecialchars($categoria['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center items-end gap-10 my-4">
                        <div class="w-full order-2 md:order-1">
                            <?= ButtonComponent(text: "Cancelar", type: "button", variant: "outline", id: "cancel-button", width: 27.5, link: "/VHS/studio/content/video",) ?>
                        </div>
                        <div class="w-full order-1 md:order-2">
                            <?= ButtonComponent(text: "Salvar Alterações", variant: "default", id: "publish-button", width: 27.5,) ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class=""> <?= Footer() ?> </footer>

    <script src="/VHS/src/views/pages/studio/content/video/script.js"></script>
</body>

</html>