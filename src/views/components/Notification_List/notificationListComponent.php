<?php
namespace Src\Views\Components;

function renderNotificationListComponent($items, $title = 'Ações') {
    // Validação básica dos dados
    if (empty($items)) {
        return '<p class="text-red-500">Erro: Nenhum item fornecido.</p>';
    }

    // Construir os itens da lista
    $listItems = '';
    foreach ($items as $item) {
        $listItems .= "<li class='flex items-center text-white'><span class='w-2 h-2 bg-purple-600 rounded-full mr-2'></span>" . htmlspecialchars($item) . "</li>";
    }

    // Construir a string do componente
    $html = <<<HTML
    <div class="container p-2">
        <div class="rounded-xl shadow-lg p-10 w-max">
            <h2 class="text-white text-xl font-semibold mb-4">$title</h2>
            <ul class="list-none space-y-2">
                $listItems
            </ul>
        </div>
    </div>
HTML;

    return $html;
}