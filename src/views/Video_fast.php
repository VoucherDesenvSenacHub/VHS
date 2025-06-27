<?php
 
 include __DIR__ . '/components/header/headerComponent.php';
 
 require "./components/fastComponent/fastComponent.php";

use function src\views\components\FastComponent\FastComponent;
use function src\views\components\header\HeaderComponent;
 
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <title>Fast</title>
</head>
<body class="bg-background">
 
<?php
 
echo HeaderComponent();
 
?>
<div class="flex mt-20 items-center justify-center ">

    <?=FastComponent(['video_url' => '/VHS/src/views/components/fastComponent/videotst.mp4',
    'titulo' => 'Jogo de matar','user' =>'João do Grau','userimg' => '/VHS/public/images/foto-sem-perfil.jpg'])?>

</div>
 
</body>
</html>
 