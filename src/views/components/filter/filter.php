<?php
namespace src\views\components\filter;

function Filter() {
    return '
        <button id="filtro" class="focus:outline-none">
            <img class="size-7" src="/VHS/public/icons/Filter.svg" alt="Filtro">
        </button>

        <div
            class="bg-[#1B1B1B] text-white rounded-lg p-4 w-48 absolute hidden border-2 border-gray-600 z-10 top-0 ml-8 mt-12"
            id="menu"
        >
            <ul class="w-full flex flex-col gap-3">
                <li
                    class=" text-white font-semibold flex w-32 h-5 text-base gap-2 items-center ml-1 cursor-pointer"
                >
                    <img src="/VHS/public/icons/clock.svg" class="w-5 h-5" />
                    <p class="text-white">Mais recentes</p>
                </li>
                <li
                    class=" text-white font-semibold flex w-32 h-5 text-base gap-2 items-center ml-1 cursor-pointer"
                >
                    <img src="/VHS/public/icons/clock2.svg" class="w-5" />
                    <p class="ml-1">Mais antigos</p>
                </li>
            </ul>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const filtrobtn = document.getElementById("filtro");
                const menubtn = document.getElementById("menu");

                filtrobtn.addEventListener("click", () => {
                    menubtn.style.display = menubtn.style.display === "flex" ? "none" : "flex";
                });

                // Fecha o menu se clicar fora
                document.addEventListener("click", (event) => {
                    if (!filtrobtn.contains(event.target) && !menubtn.contains(event.target)) {
                        menubtn.style.display = "none";
                    }
                });
            });
        </script>
    ';
}
?>
