<?php 

    namespace src\views\components\barra_lateral;
    function BarraLateralComponent(){

        return <<< HTML
            <body >
            
                <aside class="w-[9.25rem] ml-[1.87rem] h-screen">
                    <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">HOME</h2>
                    <ul>
                        <li class="menu-item flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                            <a href="../utils/Inicio.php" class="flex items-center w-full p-2">
                                <div class="icon home-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem] transition-transform duration-200">
                                    <img src="../../../../public/icons/Home.svg" alt="Início" class="transition-transform duration-200">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Início</h2>
                            </a>
                        </li>
            
                        <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                            <a href="../utils/Fast.php" class="flex items-center w-full p-2">
                                <div class="icon fast-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                                    <img src="../../../../public/icons/Fast.svg" alt="Fast">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Fast</h2>
                            </a>
                        </li>
            
                        <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                            <a href="../utils/Eventos.php" class="flex items-center w-full p-2">
                                <div class="icon eventos-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                                    <img src="../../../../public/icons/Eventos.svg" alt="Eventos">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Eventos</h2>
                            </a>
                        </li>
            
                            <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                            <a href="../utils/Histórico.php" class="flex items-center w-full p-2">
                                <div class="icon historico-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                                    <img src="../../../../public/icons/Historico.svg" alt="Histórico">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Histórico</h2>
                            </a>
                        </li>
                    </ul>
            
                    <hr class="divider w-[8.06rem] mt-[1.81rem] border-gray-800 transition-all duration-300 ease-in-out">
            
                    <h2 id="categoria-title" class="menu-text pt-[1.18rem] ml-[0.31rem] text-gray-400 text-sm font-poppins">CATEGORIA</h2>
            
                    <ul>
                        <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
                            <a href="../utils/Tecnologia.php" class="flex items-center w-full p-2">
                                <div class="icon tecnologia-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                                    <img src="../../../../public/icons/Tecnologia.svg" alt="Tecnologia">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Tecnologia</h2>
                            </a>
                        </li>
            
                        <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                            <a href="../utils/Saúde.php" class="flex items-center w-full p-2">
                                <div class="icon saude-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                                    <img src="../../../../public/icons/Saude.svg" alt="Saúde">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Saúde</h2>
                            </a>
                        </li>
            
                        <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                            <a href="../utils/Moda.php" class="flex items-center w-full p-2">
                                <div class="icon moda-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                                    <img src="../../../../public/icons/Moda.svg" alt="Moda">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Moda</h2>
                            </a>
                        </li>
            
                        <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                            <a href="../utils/Estética.php" class="flex items-center w-full p-2">
                                <div class="icon estetica-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                                    <img src="../../../../public/icons/estetica.svg" alt="Estética">
                                </div>
                                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Estética</h2>
                            </a>
                        </li>
                    </ul>
            
                    <hr class="divides w-[8.06rem] mt-[1.81rem] border-gray-800 transition-all duration-300 ease-in-out">
                </aside>
            </body>
            
            <script src="script.js"></script>
        HTML
        ;
    }