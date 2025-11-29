<?php
require_once __DIR__ . "/../../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../../components/utils/sweetalert.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\views\components\header\HeaderComponent;
use function Src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Application\Utils\showSweetAlert;

$fast = $data['fast'] ?? null;
$success = $_SESSION['redirect_data']['success'] ?? null;
$errors = $_SESSION['redirect_data']['errors'] ?? null;

if (!empty($errors)) {
    if (str_contains(strtolower($errors), 'titulo')) {
        $titleError = $errors;
    } else {
        $genericError = $errors;
    }
}
unset($_SESSION['redirect_data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fast</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>

<body class="w-full h-full bg-background">
    <div>
        <?= HeaderComponent() ?>
    </div>
    <div class="flex flex-row w-full">
        <div class="hidden md:block">
            <?= StudioSideMenuComponent() ?>
        </div>
        <div class="flex flex-col gap-4 max-w-[1500px] mx-auto w-full px-4 md:px-0">
            <div class="text-white flex flex-col gap-2">
                <h1 class='text-xl pt-6 md:text-3xl font-bold text-white text-center md:text-left'>Editar Fast</h1>
                
                <form id="uploadForm" action="/VHS/api/v1/fast/edit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $fast['id'] ?? '' ?>">
                    <div id="URL">
                        <text class="md:text-subtitle text-lg text-white font-semibold py-4">Título do Fast</text>
                        <?= InputComponent(type: "text", placeholder: "Título do fast", name: "title", value: $fast['title'] ?? "", error: !empty($titleError), errorDescription: !empty($titleError) ? $titleError : "") ?>
                    </div>
                    
                    <div class="flex flex-col mb-[3rem] mt-4 md:px-0">
                        <text class="md:text-subtitle text-lg text-white font-semibold py-4">Vídeo atual</text>
                        <div class="bg-background w-full h-[600px] border-2 rounded-xl border-solid flex items-center justify-center relative overflow-hidden md:w-[300px] md:h-[600px] border-[#666666]">
                            <video src="/VHS/public/videos/<?= $fast['url'] ?? '' ?>" class="w-full h-full object-cover rounded-lg absolute" controls></video>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center items-end gap-10 my-4">
                        <?= ButtonComponent(text: "Cancelar", variant: "outline", link: "/VHS/studio/content/fast") ?>
                        <?= ButtonComponent(text: "Salvar", variant: "default") ?>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <?php echo isset($success) ? showSweetAlert('Fast atualizado com sucesso!', $success, 'success') : ''; ?>
        </div>
</body>

</html>
