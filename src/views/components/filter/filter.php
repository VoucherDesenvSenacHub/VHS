<?php
namespace src\views\components\filter;

function Filter() {
    return <<<HTML
        <button id="filtro" class="focus:outline-none">
            <img class="size-7" src="/VHS/public/icons/Filter.svg" alt="Filtro">
        </button>

        <div
            class="bg-[#1B1B1B] text-white rounded-lg p-4 w-48 absolute hidden border-2 border-gray-600 z-10 top-0 ml-10 mt-[17rem]"
            id="menu"
        >
            <ul class="w-full flex flex-col gap-8">
                <li
                    class=" text-white font-semibold flex w-32 h-5 text-base gap-2 items-center ml-1 cursor-pointer"
                >
                    <form method="GET">
                        <button type="submit">
                            <img src="/VHS/public/icons/clock2.svg" class="w-5" />
                            <p class="ml-1">Mais recentes</p>
                        </button>
                    </form>
                </li>
                <li
                    class=" text-white font-semibold flex w-32 h-5 text-base gap-2 items-center ml-1 cursor-pointer"
                >
                    <form method="GET">
                        <button>
                            <input type="hidden" name="ordering"/>
                            <img src="/VHS/public/icons/clock2.svg" class="w-5" />
                            <p class="ml-1">Mais antigos</p>
                        </button>
                    </form>
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

                document.addEventListener("click", (event) => {
                    if (!filtrobtn.contains(event.target) && !menubtn.contains(event.target)) {
                        menubtn.style.display = "none";
                    }
                });
            });
        </script>
    HTML;
}
?>
