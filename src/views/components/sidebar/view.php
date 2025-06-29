<?php

    require_once __DIR__ . "/../header/headerComponent.php";
    use function Src\Views\Components\Header\HeaderComponent;
    
    // require_once __DIR__ . "/../sidebar/barra_lateral.php";
    // use function Src\Views\Components\Sidebar\SidebarComponent;

    require_once __DIR__ . "/../sidebar/index.php";
    use function Src\Views\Components\Sidebar\CreateSidebear;

    require_once __DIR__ . "/../cards/index.php";
    use function Src\Views\Components\Cards\renderCards;

?>
 
<!DOCTYPE html>
<html lang="pt-BR">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sidebar</title>
    
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-background">
    <?= HeaderComponent(); ?>
    
    <div class="flex">
        <?= CreateSidebear(); ?>
        
        <div class="flex w-full h-full justify-start">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5 gap-4 flex-wrap pb-20">
                <?php
                    renderCards($cards, 'video');
                    renderCards($cards, 'event');
                    renderCards($cards, 'channel');
                    renderCards($cards, 'channels');
                    renderCards($cards, 'event');
                    renderCards($cards, 'video');
                    renderCards($cards, 'channel');
                    renderCards($cards, 'channels');
                    renderCards($cards, 'event');
                    renderCards($cards, 'video');
                    renderCards($cards, 'channel');
                    renderCards($cards, 'channels');
                    renderCards($cards, 'event');
                    renderCards($cards, 'video');
                    renderCards($cards, 'channel');
                    renderCards($cards, 'channels');
                ?>
            </div>
        </div>
    </div>
</body>