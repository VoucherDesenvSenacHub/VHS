<?php
require "../components/header/headerComponent.php";

use function src\views\components\header\HeaderComponent;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico</title>
    <link rel="icon" href="../public/img/logo.svg">
    <!-- Incluindo o Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?=HeaderComponent() ?>
    </div>
    <div class="flex flex-col md:flex-row min-h-screen mt-10 ml-20">
        <div class="flex-1 p-4 sm:p-6 md:pt-16">
            <h1 class="text-xl sm:text-2xl font-bold">Histórico</h1>
            <p class="text-gray-400 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            
            <div class="mb-4 sm:mb-6 flex items-center max-w-sm sm:max-w-md md:max-w-full">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2 md:w-8 md:h-8">
                    <path d="M15.8346 2.5H4.16797C2.98946 2.5 2.4002 2.5 2.03409 2.8435C1.66797 3.187 1.66797 3.73985 1.66797 4.84555V5.4204C1.66797 6.28527 1.66797 6.7177 1.8843 7.07618C2.10064 7.43466 2.49586 7.65715 3.28632 8.10212L5.71384 9.46865C6.24419 9.7672 6.50936 9.91648 6.69923 10.0813C7.09462 10.4246 7.33803 10.8279 7.44834 11.3226C7.5013 11.5602 7.5013 11.8382 7.5013 12.3941L7.5013 14.6187C7.5013 15.3766 7.5013 15.7556 7.71124 16.0511C7.92118 16.3465 8.29404 16.4923 9.03976 16.7838C10.6053 17.3958 11.3881 17.7018 11.9447 17.3537C12.5013 17.0055 12.5013 16.2099 12.5013 14.6187V12.3941C12.5013 11.8382 12.5013 11.5602 12.5543 11.3226C12.6646 10.8279 12.908 10.4246 13.3034 10.0813C13.4932 9.91648 13.7584 9.7672 14.2888 9.46865L16.7163 8.10212C17.5067 7.65715 17.902 7.43466 18.1183 7.07618C18.3346 6.7177 18.3346 6.28527 18.3346 5.4204V4.84555C18.3346 3.73985 18.3346 3.187 17.9685 2.8435C17.6024 2.5 17.0131 2.5 15.8346 2.5Z" stroke="#C4C4C4" stroke-width="1.5"/>
                </svg>
                <input 
                    type="text" 
                    placeholder="Pesquisar" 
                    class="w-full p-2 rounded-lg bg-gray-800/20 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 md:p-3 md:text-lg">
            </div>
            <div class="ml-5">
                <p class="text-gray-400">#01/01/2000</p>
            </div>
            <!-- Grade de cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            </div>
        </div>
    </div>
</body>
</html>