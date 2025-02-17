<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Barra Lateral</title>
</head>
<body>
    <aside class="w-[9.25rem] ml-[1.87rem] h-screen bg-gray-950">
        <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-semibold">HOME</h2>
 
            <ul >
 
                <li class="flex items-center  text-gray-300 rounded-lg  cursor-pointer mt-[1.5rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img  src="../../../../public/icons/Home.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Inicio</h2>
                </li>
 
                <li class="flex items-center  text-gray-300 rounded-lg  cursor-pointer mt-[2rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img src="../../../../public/icons/Fast.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Fast</h2>
                </li>
 
                <li class="flex items-center  text-gray-300 rounded-lg  cursor-pointer mt-[2rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img src="../../../../public/icons/Eventos.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Eventos</h2>
                </li>
 
                <li class="flex items-center  text-gray-300 rounded-lg  cursor-pointer mt-[2rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img src="../../../../public/icons/Historico.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Historico</h2>
                </li>
               
            </ul>
                <hr class="w-[8.06rem] mt-[1.81rem]   border-gray-800">
            <h2 class="text-gray-400 text-xs font-semibold mt-[1.18rem] ml-[0.31rem]">CATEGORIA</h2>
 
            <ul >
 
                <li class="flex items-center  text-gray-300 rounded-lg  cursor-pointer mt-[1.5rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img src="../../../../public/icons/Tecnologia.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Tecnologia</h2>
                </li>
 
                <li class="flex items-center  text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img src="../../../../public/icons/Saude.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Saúde</h2>
                </li>
 
                <li class="flex items-center  text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img src="../../../../public/icons/Moda.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Moda</h2>
                </li>
 
                <li class="flex items-center  text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <div class="w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10  bg-white rounded-[12px] ml-[0.31rem] ">
                        <div class="w-[1rem] h-[1rem] flex items-center justify-center">
                            <img src="../../../../public/icons/estetica.svg" alt="">
                        </div>
                    </div>
                    <h2 class=" ml-[1rem] text-gray-400 text-sm font-semibold">Estética</h2>
                </li>
 
            </ul>
            <hr class="w-[8.06rem] mt-[1.81rem]  border-gray-800">
    </aside>
 
    <script>
 
        document.addEventListener("DOMContentLoaded", function () {
            const items = document.querySelectorAll("li");
            items.forEach(item => {
                item.addEventListener("click", function () {
                    items.forEach(el => {
                        el.querySelector("div").classList.remove("bg-[#5500AA]",('bg-opacity-100'));
                    });
                    item.querySelector("div").classList.add(("bg-[#5500AA]"),('bg-opacity-100'));
                });
            });
        });
 
    </script>
</body>
</html>
 
 
 
 