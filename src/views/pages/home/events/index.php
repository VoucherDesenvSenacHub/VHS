<?php

    require_once __DIR__ . "/../../../components/header/headerComponent.php";
    use function Src\Views\Components\header\HeaderComponent;

    require_once __DIR__ . "/../../../components/sidebar/SidebarComponent.php";
    use function Src\Views\Components\sidebar\SidebarComponent;

    require_once __DIR__ . "/../../../components/cards/index.php";
    use function Src\Views\Components\Cards\renderCards;

?>

<!-- H T M L -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body class="bg-[#0C0118]">
    <?= HeaderComponent(); ?>

    <div class="w-full h-full flex">
        <?= SidebarComponent(); ?>

        <div class="w-full h-full flex flex-col gap-6 p-4">
            <div class="flex w-full h-40 bg-gray-600 rounded-3xl"></div>

            <div class="w-full h-full grid grid-cols-4 gap-4">
                <?= renderCards($cards, "event"); ?>
                <?= renderCards($cards, "event"); ?>
                <?= renderCards($cards, "event"); ?>
                <?= renderCards($cards, "event"); ?>
                <?= renderCards($cards, "event"); ?>
                <?= renderCards($cards, "event"); ?>
            </div>
        </div>
    </div>
</body>
</html>