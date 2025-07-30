<?php

namespace src\views\components\barra_admin;

function Barra_Admin()
{
    return '  
            <aside class="sticky top-24 w-[9.25rem] ml-[1.87rem] transition-all duration-500 ease-in-out" id="sidebar">
                <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">ADMINISTRAÇÃO</h2>
                <ul class="space-y-6">
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                        <a href="/VHS/src/views/adm/Analytics/index.php" class="flex items-center w-full p-2">
                            <button id="analytics-btn" class="icon Analytics-icon p-2 flex items-center justify-center bg-white/5 rounded-lg ml-[0.31rem] ">
                                <img class="w-6 h-6" src="/VHS/public/icons/sidebar_admin/chart-column.svg" alt="Analytics">
                            </button>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Analytics</h2>
                        </a>
                    </li>
        
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer farming-[2rem]">
                        <a href="/VHS/src/views/adm/user_management/index.php" class="flex items-center w-full p-2">
                            <button id="usuarios-btn" class="icon Usuarios-icon p-2 flex items-center justify-center bg-white/5 rounded-lg ml-[0.31rem]">
                                <img class="w-6 h-6" src="/VHS/public/icons/sidebar_admin/users.svg" alt="Usuarios">
                            </button>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Usuários</h2>
                        </a>
                    </li>
                </ul>
            </aside>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const menuItems = document.querySelectorAll("#sidebar ul li a");

                    // Função para definir o item ativo
                    function setActiveItem(href) {
                        menuItems.forEach(item => {
                            const button = item.querySelector("button");
                            button.classList.remove("bg-[#660BAD]");
                            if (item.getAttribute("href") === href) {
                                button.classList.add("bg-[#660BAD]");
                            }
                        });
                        localStorage.setItem("activeItem", href);
                    }

                    // Verificar o estado salvo no localStorage
                    const activeItem = localStorage.getItem("activeItem");
                    if (activeItem) {
                        setActiveItem(activeItem);
                    }

                    // Adicionar eventos de clique
                    menuItems.forEach(item => {
                        item.addEventListener("click", function(event) {
                            const href = item.getAttribute("href");
                            setActiveItem(href);
                        });
                    });
                });
            </script>
        ';
}
?>