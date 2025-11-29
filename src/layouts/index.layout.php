<?php

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;


function indexLayout($yield) {
    require __DIR__ . "/../views/components/header/headerComponent.php";
    require __DIR__ . "/../views/components/sidebar/index.php";
    $header = HeaderComponent();
    $sidebar = SidebarComponent();
    $yield = require_once $yield;

    return <<<HTML
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>VHS - Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="/VHS/src/styles/global.css">
        <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="bg-gradient-to-b from-[#20002c] to-black text-white">
        <header class="w-full">
            $header
        </header>
        <div class="flex">
            <aside class="w-[240px]">
                $sidebar
            </aside>
            <main class="flex-1 p-4 max-w-[1500px] m-auto">
                $yield
            </main>
        </div>
    </body>
    HTML;
}
?>
