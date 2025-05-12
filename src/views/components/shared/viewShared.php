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

<body class="m-0 p-0 w-[100vw] h-[100vh] flex items-center justify-center bg-gray-700">
<div id="container" class="w-full h-full flex items-center justify-center">

    <div class="modal absolute flex inset-0 bg-black/25 items-center justify-center">

        <div class="flex flex-col bg-[#1B1B1B] w-auto h-64 rounded-2xl p-6 justify-between shadow-xl">
            <div class="w-full flex flex-row justify-between items-center">
                <h2 class="text-white text-xl">Compartilhar</h2>
    
                <button onclick="closePopup()" class="flex justify-center items-center w-7 text-purple-400 hover:text-purple-600">
                    <img src="../../../../public/icons/botaoFechar.svg" class="w-full h-full">
                </button>
            </div>

            <div class="flex justify-between">
                <div id="telegram" class="w-12 h-12 bg-white/5 rounded-full">
                    <img src="../../../../public/icons/telegram.svg" alt="">
                </div>
                <div id="facebook" class="w-12 h-12 bg-white/5 rounded-full">
                    <img src="../../../../public/icons/facebook.svg" alt="">
                </div>
                <div id="whatsapp" class="w-12 h-12 bg-white/5 rounded-full">
                    <img src="../../../../public/icons/whats.svg" alt="">
                </div>
                <div id="instagram" class="w-12 h-12 bg-white/5 rounded-full">
                    <img src="../../../../public/icons/insta.svg" alt="">
                </div>
                <div id="twitter" class="w-12 h-12 bg-white/5 rounded-full">
                    <img src="../../../../public/icons//twitter.svg" alt="">
                </div>
            </div>

            <div class="flex flex-row justify-between gap-3">
                <input type="text" value="https://youtube.com/@freitasdev" class="focus:outline-none text-gray-500 text-sm p-2 w-72 border-[1px] border-[#666666] bg-transparent rounded-[10px]">
                <button class="bg-[#6C00C0] p-3 px-7 rounded-[10px] text-white">Copiar</button>
            </div>
        </div>
    
    </div>
    
    <button name="send" class="border-0 bg-blue-600 p-4 rounded-full font-bold text-white shadow-md hover:bg-blue-500" onclick="showPopup()" >Compartilhar</button>

</div>

    <script>
        function showPopup() {
            document.querySelector('.modal').classList.remove('hidden');
        }
        
        function closePopup() {
            document.querySelector('.modal').classList.add('hidden');
        }
    </script>

</body>
</html>