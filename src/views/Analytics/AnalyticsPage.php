<?php
require "../components/header/headerComponent.php";
require "../components/barra_admin/barra_admin.php";
require "../components/Perfil_Analytics/Perfil_Analytics.php";

use function src\views\components\Header\HeaderComponent;
use function src\views\components\Header\Barra_Admin;
use function src\views\components\Perfil_Analytics\renderPostComponent;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div>
        <?= Barra_Admin() ?>
    </div>

    <div>
        <?php
        // Chame a função com os dados desejados
        renderPostComponent("Freitadev", "Boa tarde, Freitadev", "Quinta, 15 de agosto");

        // Ou com outros dados
        renderPostComponent("OutroUsuario", "Olá, mundo!", "Quarta, 18 de junho de 2025", "outra-imagem.jpg");
        ?>
    </div>

</body>

</html>