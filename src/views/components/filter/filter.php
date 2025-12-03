<?php

namespace src\views\components\filter;

function Filter(string $pesquisa, string $ordenacao)
{
    $pesquisaEncoded = urlencode($pesquisa);

    $maisRecentesSelected = $ordenacao === 'desc' ? 'opacity-100 text-white font-medium' : '';
    $maisAntigosSelected = $ordenacao === 'asc' ? 'opacity-100 text-white font-medium' : '';

    return <<<HTML
<div id="filter" class="absolute right-0 top-full mt-2 z-20 hidden flex flex-col bg-[#121214] border border-white/10 rounded-xl p-2 w-48 gap-1 shadow-2xl backdrop-blur-xl cursor-pointer transform origin-top-right transition-all">

    <a href="?search={$pesquisaEncoded}&sort=desc" 
       class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-white/5 transition-all cursor-pointer group {$maisRecentesSelected}">
       
        <div class="p-1.5 rounded-md bg-white/5 group-hover:bg-white/10 transition-colors">
            <img src="/VHS/public/icons/time-svgrepo-com.svg" 
                 class="size-4 rotate-[-110deg] opacity-60 group-hover:opacity-100 transition-opacity">
        </div>
             
        <p class="text-sm font-medium text-gray-300 group-hover:text-white transition-colors">
            Mais recentes
        </p>
    </a>

    <a href="?search={$pesquisaEncoded}&sort=asc" 
       class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-white/5 transition-all cursor-pointer group {$maisAntigosSelected}">
       
        <div class="p-1.5 rounded-md bg-white/5 group-hover:bg-white/10 transition-colors">
            <img src="/VHS/public/icons/time-svgrepo-com.svg" 
                 class="size-4 opacity-60 group-hover:opacity-100 transition-opacity">
        </div>
             
        <p class="text-sm font-medium text-gray-300 group-hover:text-white transition-colors">
            Mais antigos
        </p>
    </a>
</div>

<script>
    function showFilterMenu() {
        const filter = document.getElementById('filter');
        filter.classList.toggle('hidden');
        
        // Close when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = filter.contains(event.target) || event.target.closest('[onclick*="showFilterMenu"]');
            if (!isClickInside && !filter.classList.contains('hidden')) {
                filter.classList.add('hidden');
            }
        }, { once: true }); // Use once to avoid stacking listeners, though logic might need refinement for toggle
    }
</script>
HTML;
}
