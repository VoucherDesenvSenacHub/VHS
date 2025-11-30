<?php

namespace src\views\components\filter;

function Filter(string $pesquisa, string $ordenacao)
{
    $pesquisaEncoded = urlencode($pesquisa);

    $maisRecentesSelected = $ordenacao === 'desc' ? 'opacity-100 text-white font-medium' : '';
    $maisAntigosSelected = $ordenacao === 'asc' ? 'opacity-100 text-white font-medium' : '';

    return <<<HTML
<div id="filter" class="absolute right-0 top-full mt-2 z-10 hidden flex flex-col bg-[#2A2A2C] rounded-lg p-2 w-48 gap-2 shadow-xl cursor-pointer">

    <a href="?search={$pesquisaEncoded}&sort=desc" 
       class="flex items-center gap-2 p-1 rounded hover:bg-white/5 transition-colors cursor-pointer group">
       
        <img src="/VHS/public/icons/time-svgrepo-com.svg" 
             class="size-5 rotate-[-110deg] opacity-50 group-hover:opacity-100 transition-opacity {$maisRecentesSelected}">
             
        <p class="text-[13px] font-poppins text-gray-200 {$maisRecentesSelected}">
            Mais recentes
        </p>
    </a>

    <a href="?search={$pesquisaEncoded}&sort=asc" 
       class="flex items-center gap-2 p-1 rounded hover:bg-white/5 transition-colors cursor-pointer group">
       
        <img src="/VHS/public/icons/time-svgrepo-com.svg" 
             class="size-5 opacity-50 group-hover:opacity-100 transition-opacity {$maisAntigosSelected}">
             
        <p class="text-[13px] font-poppins text-gray-200 {$maisAntigosSelected}">
            Mais antigos
        </p>
    </a>
</div>

<script>
    function showFilterMenu() {
        const filter = document.getElementById('filter');
        filter.classList.toggle('hidden');
    }
</script>
HTML;
}
