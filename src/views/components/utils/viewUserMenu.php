<?php

    require_once __DIR__ . "/../header/headerComponent.php";
    use function Src\Views\Components\Header\HeaderComponent;

?>

<!-- H T M L -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example View</title>

    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-background flex items-center justify-center">
<div class="w-full h-full">

    <?= HeaderComponent(); ?>

</div>
</body>
</html>