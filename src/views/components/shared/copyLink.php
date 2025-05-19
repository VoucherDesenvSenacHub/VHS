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

<body class="m-0 p-0 w-[100vw] h-[100vh] flex items-center justify-center bg-black/90">
<div id="container" class="w-full h-full flex items-center justify-center">

    <div class="min-w-20 min-h-10 bg-[#202024] rounded-xl flex items-center p-4 gap-4 border-b-4 border-[#660BAD] overflow-hidden">
        <div class="w-12 h-12 bg-[#303746] rounded-full flex items-center justify-center p-2" style="box-shadow: 0 0 50px 0 #660BAD;">
            <svg width="100%" height="100%" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z" fill="#660BAD"/>
            </svg>
        </div>

        <div class="flex flex-col text-white">
            <h1 class="text-xl">Link copiado</h1>
            <span class="text-gray-500 text-base">O link foi copiado com sucesso!</span>
        </div>
    </div>

</div> <!-- # -->
</body>
</html>