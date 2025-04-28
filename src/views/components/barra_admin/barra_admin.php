<?php
function barra_admin(){
    return('
        <aside class="w-36 ml-8 h-screen">

            <h2 class=" pt-5 ml-1 text-gray-400 text-xs font-poppins">ADMINISTRAÇÃO</h2>

            <ul>
    
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-8">

                    <a href="./analytics.php" class="flex items-center w-full p-2">

                        <div class="icon analytics-icon w-8 h-8 flex items-center justify-center bg-opacity-10 bg-white rounded-xl ml-1">

                            <img src="/VHS/public/images/chart.svg" alt="analytics">

                        </div>

                        <h2 class="menu-text ml-4 text-gray-400 text-sm font-semibold transition-opacity duration-200">Analytics</h2>

                    </a>

                </li>
 
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-8">

                    <a href="./usuarios.php" class="flex items-center w-full p-2" class="flex items-center w-full p-2">

                        <div class="icon usuarios-icon w-8 h-8 flex items-center justify-center bg-opacity-10 bg-white rounded-xl ml-1">

                            <img src="/VHS/public/images/group.svg" alt="usuários">

                        </div>

                        <h2 class="menu-text ml-4 text-gray-400 text-sm font-semibold transition-opacity duration-200">Usuários</h2>

                    </a>

                </li>

            </ul>
            
            <script src="script.js"></script>

            '
            
    );

}
?>