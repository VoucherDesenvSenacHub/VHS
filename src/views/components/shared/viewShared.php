<?php

    require_once './shared.php';

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

<body class="m-0 p-0 w-[100vw] h-[100vh] flex items-center justify-center bg-gray-900">
<div id="container" class="w-full h-full flex items-center justify-center">

    <div class="absolute flex inset-0 bg-black/25 items-center justify-center">
        <div class="bg-[#1B1B1B] w-60 h-60 rounded-[10px] p-4">
            <h2 class="text-white">Compartilhar</h2>
        </div>
    </div>
    
    <button name="send" class="border-0 bg-blue-600 p-4 rounded-full font-bold text-white shadow-md hover:bg-blue-500" onclick="showPopup()" >Compartilhar</button>

    <button onclick="closePopup()" class="text-purple-400 hover:text-purple-600">
        <img src="../../../../public/icons/botaoFechar.svg" alt="">
    </button>

</div>

    <script>
         function showPopup() {
            document.getElementById('container').classList.remove('hidden');
        }
        
        function closePopup() {
            document.getElementById('container').classList.add('hidden');
        }

    </script>

</body>
</html>