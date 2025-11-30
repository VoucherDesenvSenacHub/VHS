<?php
require_once __DIR__ . "/../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../components/utils/textareaComponent.php";
require_once __DIR__ . "/../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../components/utils/sweetalert.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\TextareaComponent;
use function Src\views\components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Application\Utils\showSweetAlert;

$video = $_SESSION["page_data"]["video"] ?? [];
$categorias = $_SESSION["page_data"]["categorias"] ?? [];

$id = $video["id"] ?? "";
$thumbPath = '';

if (!empty($video) && !empty($video['thumbnail_url'])) {
    $url = $video['thumbnail_url'];
    $url = preg_replace('#^/VHS+#', '/VHS', $url);
    if (!str_starts_with($url, '/VHS')) {
        $url = '/VHS' . $url;
    }
    $thumbPath = $url;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Edição de Vídeo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
    <?= HeaderComponent(); ?>

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>

        <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

            <!-- Header & Navigation -->
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Edição de Vídeo</h1>
                    <p class="text-gray-400 mt-1">Atualize os detalhes do seu vídeo</p>
                </div>

                <div class="flex p-1 bg-[#121214] border border-white/5 rounded-xl">
                    <a href="/VHS/studio/content/video/edit?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium bg-purple-600 text-white shadow-lg transition-all">
                        Edição
                    </a>
                    <a href="/VHS/studio/content/video/commentary?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                        Comentários
                    </a>
                    <a href="/VHS/studio/content/video/analytic?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                        Analytics
                    </a>
                </div>
            </div>

            <form action="/VHS/api/v1/studio/content/video/edit" enctype="multipart/form-data" method="post" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <input type="hidden" name="id" value="<?= htmlspecialchars($video["id"] ?? "") ?>">
                <input type="hidden" name="old_thumbnail" value="<?= htmlspecialchars($video["thumbnail_url"] ?? "") ?>">

                <!-- Left Column: Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 space-y-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Detalhes</h2>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Título</label>
                            <?= InputComponent(
                                type: "text",
                                placeholder: "Título do vídeo",
                                value: $video["title"] ?? "",
                                name: "title"
                            ) ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Descrição</label>
                            <?= TextareaComponent(
                                type: "text",
                                placeholder: "Descrição do vídeo...",
                                height: "48",
                                name: "description",
                                value: $video["description"] ?? ""
                            ) ?>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Categoria</label>
                            <div class="relative">
                                <select name="category_id" class="w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500 transition-colors appearance-none cursor-pointer">
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id'] ?>" <?= ($video["category_id"] == $categoria['id']) ? "selected" : "" ?>>
                                            <?= htmlspecialchars($categoria['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Thumbnail & Actions -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-white mb-4">Thumbnail</h2>

                        <div class="relative w-full aspect-video rounded-xl border-2 border-dashed border-white/10 hover:border-purple-500/50 transition-colors overflow-hidden group bg-[#050505]">
                            <input id="dropzone-file" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/png, image/jpg, image/jpeg" name="thumbnail" />

                            <div id="uploadText" class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center <?= !empty($thumbPath) ? 'hidden' : '' ?>">
                                <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-400 font-medium">Clique ou arraste uma imagem</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG ou JPEG</p>
                            </div>

                            <img id="thumbnailPreview" src="<?= htmlspecialchars($thumbPath) ?>" class="absolute inset-0 w-full h-full object-cover <?= empty($thumbPath) ? 'hidden' : '' ?>" alt="Preview" />

                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                <span class="text-white text-sm font-medium">Alterar imagem</span>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col gap-3">
                            <?= ButtonComponent(text: "Salvar Alterações", variant: "default", type: "submit", className: "w-full") ?>
                            <?= ButtonComponent(text: "Cancelar", variant: "outline", type: "button", link: "/VHS/studio/content/video", className: "w-full") ?>
                        </div>
                    </div>
                </div>
            </form>

        </main>
    </div>

    <script src="/VHS/src/views/pages/studio/content/video/script.js"></script>
</body>

</html>