<?php
require_once __DIR__ . "/../../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../../components/studioSideMenu/studioSideMenuComponent.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\views\components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;

$fast = $_SESSION["page_data"]["fast"] ?? [];
$id = $fast["id"] ?? "";

$videoUrl = "/VHS/public/videos/" . $fast['url'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Edição de Fast</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
    <?= HeaderComponent(); ?>

    <div class="flex min-h-screen">
        <?= StudioSideMenuComponent(); ?>

        <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

            <!-- Header & Navigation -->
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Edição de Fast</h1>
                    <p class="text-gray-400 mt-1">Atualize os detalhes do seu vídeo curto</p>
                </div>
            </div>

            <form action="/VHS/api/v1/fast/edit" method="post" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <input type="hidden" name="id" value="<?= htmlspecialchars($fast["id"] ?? "") ?>">

                <!-- Left Column: Details -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 space-y-6">
                        <h2 class="text-lg font-semibold text-white mb-4">Detalhes</h2>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Título</label>
                            <?= InputComponent(
                                type: "text",
                                placeholder: "Título do fast",
                                value: $fast["title"] ?? "",
                                name: "title"
                            ) ?>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-white/5 mt-2">
                            <?= ButtonComponent(text: "Salvar Alterações", variant: "default", type: "submit", className: "w-full sm:w-auto px-8") ?>
                            <?= ButtonComponent(text: "Cancelar", variant: "outline", type: "button", link: "/VHS/studio/content/fast", className: "w-full sm:w-auto px-8") ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Preview -->
                <div class="lg:col-span-1">
                    <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 sticky top-24 flex flex-col items-center">
                        <h2 class="text-lg font-semibold text-white mb-4 w-full">Preview</h2>

                        <div class="relative w-full max-w-[25rem] aspect-[9/16] rounded-xl overflow-hidden bg-black border border-white/10 shadow-lg group">
                            <?php if (!empty($videoUrl)): ?>
                                <video
                                    src="<?= $videoUrl ?>"
                                    class="w-full h-full object-cover"
                                    controls
                                    playsinline
                                    loop></video>
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-500">
                                    <p>Vídeo não disponível</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <p class="text-xs text-gray-500 mt-4 text-center">Visualização do seu Fast</p>
                    </div>
                </div>
            </form>

        </main>
    </div>
</body>

</html>