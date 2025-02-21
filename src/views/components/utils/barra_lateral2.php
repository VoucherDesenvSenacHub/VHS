<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animação para desaparecer o texto */
        @keyframes desaparecer {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        /* Aplica a animação ao texto */
        .desaparecer-texto {
            animation: desaparecer 3s ease-in-out forwards; /* 3s de duração */
        }

        /* Ajusta o tamanho das barras (<hr>) para o mesmo tamanho dos quadradinhos */
        hr {
            width: 2rem; /* Mesmo tamanho dos quadradinhos */
            margin-left: 0.31rem; /* Alinhar com os ícones */
            border: 1px solid #4A5568; /* Cor da borda */
        }
    </style>
    <title>Barra Lateral</title>
</head>
<body class="flex bg-gray-950">
    <aside class="w-[9.25rem] ml-[1.87rem] h-screen">
        <h2 class="pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-semibold">HOME</h2>
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

        <hr class="mt-[1.81rem] border-gray-800">
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

        <hr class="mt-[1.81rem] border-gray-800">
    </aside>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const texto = document.querySelectorAll("h2"); // Seleciona todos os textos
            const barras = document.querySelectorAll("hr"); // Seleciona todas as barras

            // Função para ativar a animação
            setTimeout(() => {
                // Aplica a classe para desaparecer o texto
                texto.forEach(t => t.classList.add("desaparecer-texto"));

                // Ajusta o tamanho das barras
                barras.forEach(barra => {
                    barra.style.width = "2rem"; // Mesmo tamanho dos quadradinhos
                    barra.style.marginLeft = "0.31rem"; // Alinhar com os ícones
                });
            }, 1000); // Inicia a animação após 1 segundo
        });
    </script>
</body>
</html>