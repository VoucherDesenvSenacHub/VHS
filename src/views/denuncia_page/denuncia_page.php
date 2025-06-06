<?php
require "../components/header/headerComponent.php";
require "../components/barra_admin/barra_admin.php";
require "../components/utils/inputComponent.php";
require "../components/utils/cardDenunciationComponent.php";

use function src\Views\Components\utils\cardDenunciationComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\header\Barra_Admin;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../styles/tailwindglobal.js"></script>
</head>
<body class="w-full bg-[#0C0118]">
    <?php HeaderComponent(); ?>
    <div class="flex">
        <div class="max-xl:hidden mr-4">
            <?php Barra_Admin(); ?>
        </div>
        <div class="p-7 w-full">
            <div>
                <p class="font-pop font-semibold text-title text-white">Gerenciamento de usuários</p>
                <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex h-5 mt-5 gap-5">
                <a class="text-white bg-gray600 rounded-full w-28 h-8 flex items-center justify-center">Usuários</a>
                <a href="../Perfil_Empresa.php" class="text-gray-500 bg-gray600 rounded-full w-28 h-8 flex items-center justify-center">Denúncias</a>
            </div>
            <div class="mt-10 flex items-center gap-4 h-16 cavalo">
                <button id="btn_filter" onclick="filter(event)">
                    <img class="size-7" src="../../../public/icons/filter-svgrepo-com.svg" alt="">
                </button>
                <input type="text" placeholder="Pesquisar" class="pl-2 rounded-lg bg-transparent text-white w-full h-12 border-[0.5px] border-gray-500">
            </div>
            <div id="filter" class="absolute left-[16.5rem] z-10 hidden flex flex-col bg-gray-900 rounded-lg p-2 max-w-32 border-[0.5px] border-gray-500">
                <div class="flex">
                    <img src="../../../public/icons/time-svgrepo-com.svg" alt="" class="size-6 rotate-[-110deg]">
                    <p class="text-[13px] flex items-center text-gray-200">Mais recentes</p>
                </div>
                <div class="flex flex-row">
                    <img src="../../../public/icons/time-svgrepo-com.svg" class="size-6" alt="">
                    <p class="text-[13px] flex items-center text-gray-200">Mais antigos</p>
                </div>
            </div>
            <div class="colocaraqui mt-10 flex flex-col gap-4">
                
                <?php
                    echo cardDenunciationComponent(
                        "https://i.pinimg.com/736x/fb/e5/ba/fbe5bae9c8ccfc33af55485effe11b15.jpg",
                        "CALANGO",
                        "80808-45454-27272-12121",
                        "Criador de conteudo",
                        1
                    );
                    echo cardDenunciationComponent(
                        "https://yt3.googleusercontent.com/L8Rm0h8FjQ0t9eGytIvaT8oV43v5K0tX6lmTndcbOpPOBoHcgITnuqK-1jUfNY0CTSUSul4ffg=s900-c-k-c0x00ffffff-no-rj",
                        "CAVALO",
                        "13131-31313-13131-31313",
                        "Criador de conteudo",
                        2
                    );
                ?>
            </div>
        </div>
    </div>
    <script>
        function filter(event) {
            event.stopPropagation();
            var filter = document.getElementById("filter");
            filter.classList.toggle("hidden");
        }

        
        function cargo(index) {
            event.stopPropagation();
            var cargo = document.getElementById(`cargo_${index}`);
            var ban = document.getElementById(`ban_${index}`);
            if (cargo) {
                if (ban && !ban.classList.contains("hidden")) {
                    ban.classList.add("hidden");
                    ban.style.zIndex = "10";
                }
                cargo.classList.toggle("hidden");
                
            } else {
                console.error(`Elemento com id cargo_${index} não encontrado`);
            }
        }
        
        function ban(index){
            var ban = document.getElementById(`ban_${index}`);
            var cargo = document.getElementById(`cargo_${index}`);
            event.stopPropagation();
            if(ban){
                if (cargo && !cargo.classList.contains("hidden")) {
                    cargo.classList.add("hidden");
                    cargo.style.zIndex = "10";
                }
                ban.classList.toggle("hidden");
                
            }
        }

        document.addEventListener("click", function (event) {
            var filter = document.getElementById("filter");
            var filterButton = document.getElementById("btn_filter");
            if (filter && filterButton && !filter.contains(event.target) && !filterButton.contains(event.target)) {
                filter.classList.add("hidden");
                
            }

            document.querySelectorAll("[id^='cargo_']").forEach(cargo => {
                if (!cargo.contains(event.target) && !event.target.closest("[id^='btn_cargo_']")) {
                    cargo.classList.add("hidden");
                }
            });
            document.querySelectorAll("[id^='ban_']").forEach(ban => {
                if (!ban.contains(event.target) && !event.target.closest("[id^='btn_ban_']")) {
                    ban.classList.add("hidden");
                }
            });
        });
    </script>
</body>
</html>