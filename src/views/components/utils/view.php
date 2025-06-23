<?php

require_once __DIR__ . "/../header/headerComponent.php";
use function Src\Views\Components\Header\HeaderComponent;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-background">
    <?= HeaderComponent(); ?>
</body>
</html>