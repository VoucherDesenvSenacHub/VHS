<?php
require "../components/Perfil_Analytics/Perfil_Analytics.php";
require "../components/utils/userActivityCardsComponent.php";
require "../components/barra_admin/barra_admin.php";
require "../components/header/headerComponent.php";

use function src\views\components\header\Barra_Admin;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\Utils\UserActivityCardsComponent;
use function Src\Views\Components\Perfil_Analytics\renderPostComponent;
;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
    <?= HeaderComponent()?>
    </div>
    <div>
        <?= Barra_Admin()?>
    </div>
    <?php
    // Exemplo de URL de imagem (substitua por uma URL válida)
    renderPostComponent("");
    ?>
    <div>
        <?= UserActivityCardsComponent("ahdiwhduhd",62375)?>
    </div>
</body>
</html>