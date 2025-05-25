<?php

    require_once './shared.php';
    use function Src\Views\Components\Shared\sharedComponent;

?>

<!-- H T M L -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins', system-ui;
        }
    </style>
</head>

<body class="m-0 p-0 w-[100vw] h-[100vh] flex items-center justify-center bg-gray-700">
<div id="container" class="w-full h-full flex items-center justify-center">

    <button name="send" class="border-0 bg-blue-600 p-4 rounded-full font-bold text-white shadow-md hover:bg-blue-500" onclick="openShared()">Compartilhar</button>
    <?= sharedComponent(); ?>
    
</div>
</body>
</html>