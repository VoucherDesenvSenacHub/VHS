<?php 
require __DIR__ . "/../header/headerComponent.php";
use function Src\Views\Components\header\HeaderComponent;

require __DIR__ . "/barra_lateral.php";
use function Src\Views\Components\sidebar\SidebarComponent;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-black">
    <?= HeaderComponent(); ?>
    <?= SidebarComponent(); ?>

</body>
</html>