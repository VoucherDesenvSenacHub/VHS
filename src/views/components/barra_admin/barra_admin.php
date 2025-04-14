<?php
function barra_admin(){
    return('
        <aside class="w-[9.25rem] ml-[1.87rem] h-screen">

            <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">ADMINISTRAÇÃO</h2>

            <ul>
    
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">

                    <a href="./analytics.php" class="flex items-center w-full p-2">

                        <div class="icon analytics-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">

                            <img src="./../../../public/images/chart.svg" alt="analytics">

                        </div>

                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Analytics</h2>

                    </a>

                </li>
 
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">

                    <a href="./usuarios.php" class="flex items-center w-full p-2" class="flex items-center w-full p-2">

                        <div class="icon usuarios-icon w-[2rem] h-[2rem] flex items-center justify-center bg-opacity-10 bg-white rounded-[12px] ml-[0.31rem]">

                            <img src="./../../../public/images/group.svg" alt="usuários">

                        </div>

                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-opacity duration-200">Usuários</h2>

                    </a>

                </li>

            </ul>
            
            <script src="script.js"></script>

            '
            
    );

}
?>