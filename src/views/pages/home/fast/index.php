<?php
 
require_once __DIR__ . '/../../../components/header/headerComponent.php';
require "../../../components/fastComponent/fastComponent.php";
require "../../../components/sidebar/SidebarComponent.php";

 
use function src\views\components\FastComponent\FastComponent;
use function src\views\components\header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;

 
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <title>VHS - Fast</title>
</head>
<body>
    <?= HeaderComponent() ?>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>

        <section class="flex flex-col justify-center max-w-[1500px] mx-auto w-1/4" style="height: calc(100vh - 10rem);">
            <?= FastComponent(
                ['video_url' => '/VHS/src/views/components/fastComponent/video_test.mp4',
                    'titulo' => 'JOGANDO EURO TRUCK SIMULATOR 2! MUITO TOP!','user' =>'Bolsonaro','userimg' => 'https://agenciainfra.com/blog/wp-content/uploads/2021/09/bolsonaro-foto-fabio-rodrigues-pozzebom-agencia-brasil.jpg']) ?>
        </section>

    </div>

</body>
</html>
 