<?php

namespace src\views\components\header;

    function sideBarStudio(){
        return 
        '
        <aside class="w-[9.25rem] ml-[1.87rem] h-screen">
            <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">VHS STUDIO</h2>
            <ul>
                <li class="menu-item flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                    <a href="" class="flex items-center w-full p-2">
                        <div class="icon home-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem] transition-transform duration-200">
                            <img src="/VHS/public/icons/analytics.svg" alt="Início" class="transition-transform duration-200">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Analytics</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="" class="flex items-center w-full p-2">
                        <div class="icon fast-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="/VHS/public/icons/conteudo.svg" alt="Fast">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Conteúdo</h2>
                    </a>
                </li>

                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="" class="flex items-center w-full p-2">
                        <div class="icon eventos-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="/VHS/public/icons/customizar.svg" alt="Eventos">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Customizar</h2>
                    </a>
                </li>

                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="" class="flex items-center w-full p-2">
                        <div class="icon historico-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="/VHS/public/icons/comentarios.svg" alt="Histórico">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Comentários</h2>
                    </a>
                </li>

                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
                    <a href="../utils/Tecnologia.php" class="flex items-center w-full p-2">
                        <div class="icon tecnologia-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">
                            <img src="/VHS/public/icons/criar.svg" alt="Tecnologia">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Criar</h2>
                    </a>
                </li>
                
            </ul>
        </aside>
        <script src="/VHS/src/views/components/studioSideBar/script.js"></script>
        ';
        

    }

?>
