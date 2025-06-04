<?php
require "../components/utils/Title_and_buttons.php";
require "../components/header/headerComponent.php";

use function src\views\components\header\HeaderComponent;
use function src\views\components\utils\Title_and_buttons;

$botoes = [
    ['texto' => 'Vídeos', 'link' => './VideosPage.php'],
    ['texto' => 'Fast', 'link' => './FeastPage.php'],
    ['texto' => 'Eventos', 'link' => './EventosPage.php'],
    ['texto' => 'Canais', 'link' => './CanaisPage.php']
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canais</title>
    <link rel="icon" href="../public/img/logo.svg">
    <!-- Incluindo o Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?=HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row min-h-screen mt-10 ml-20">
        <?= Title_and_buttons("canais","loren",$botoes)?>
        <div class="flex-1 p-4 sm:p-6 md:pt-16">
            <div class="mt-6">
                <div class="flex items-center justify-between py-4 border-b border-gray-700/50">
                <!--CONTEUDO AQUI !!!-->
                </div>
            </div>
        </div>
    </div>
</body>
</html>