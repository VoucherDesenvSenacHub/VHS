    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Barra Lateral</title>
    </head>
    <body class="flex">

        <aside class="w-[9.25rem] ml-[1.87rem] h-screen bg-gray-950">
            <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-semibold">HOME</h2>
            <ul>
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
                    <a href="../utils/Inicio.php" class="flex items-center w-full p-2">
                        <div class="icon home-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/Home.svg" alt="Início">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Início</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="../utils/Fast.php" class="flex items-center w-full p-2">
                        <div class="icon fast-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/Fast.svg" alt="Fast">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Fast</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="../utils/Eventos.php" class="flex items-center w-full p-2">
                        <div class="icon eventos-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/Eventos.svg" alt="Eventos">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Eventos</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="../utils/Histórico.php" class="flex items-center w-full p-2">
                        <div class="icon historico-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/Historico.svg" alt="Histórico">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Histórico</h2>
                    </a>
                </li>
            </ul>

            <hr class="w-[8.06rem] mt-[1.81rem] border-gray-800">
            <h2 class="text-gray-400 text-xs font-semibold mt-[1.18rem] ml-[0.31rem]">CATEGORIA</h2>

            <ul>
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
                    <a href="../utils/Tecnologia.php" class="flex items-center w-full p-2">
                        <div class="icon tecnologia-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/Tecnologia.svg" alt="Tecnologia">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Tecnologia</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="../utils/Saúde.php" class="flex items-center w-full p-2">
                        <div class="icon saude-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/Saude.svg" alt="Saúde">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Saúde</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="../utils/Moda.php" class="flex items-center w-full p-2">
                        <div class="icon moda-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/Moda.svg" alt="Moda">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Moda</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="../utils/Estética.php" class="flex items-center w-full p-2">
                        <div class="icon estetica-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/estetica.svg" alt="Estética">
                        </div>
                        <h2 class="ml-[1rem] text-gray-400 text-sm font-semibold">Estética</h2>
                    </a>
                </li>
            </ul>

            <hr class="w-[8.06rem] mt-[1.81rem] border-gray-800">
        </aside>

        <script>

        document.addEventListener("DOMContentLoaded", function () {
        const items = document.querySelectorAll("li");

        const barraLateral = {
            "Inicio.php": "home-icon",
            "Fast.php": "fast-icon",
            "Eventos.php": "eventos-icon",
            [encodeURIComponent("Histórico.php")]: "historico-icon",
            "Tecnologia.php": "tecnologia-icon",
            [encodeURIComponent("Saúde.php")]: "saude-icon",
            "Moda.php": "moda-icon",
            [encodeURIComponent("Estética.php")]: "estetica-icon"
        };

        for (const barra in barraLateral) {

        if (location.pathname.includes(barra)) {
            console.log(barra)
            document.querySelector(`.${barraLateral[barra]}`).classList.add("bg-[#660BAD]", "bg-opacity-100");
        }
    }

    });
        </script>
    </body>
    </html>
