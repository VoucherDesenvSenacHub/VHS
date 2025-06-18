<?php
namespace src\views\components\utils;

function Title_and_buttons($titulo, $subtitulo, $botoes, $conteudos = []) {
    $botoesHtml = '';
    foreach ($botoes as $botao) {
        $texto = $botao['texto'];
        $link = $botao['link'];
        $botoesHtml .= "<a href='$link'>
            <button class='px-4 py-2 bg-gray-700/50 rounded-full text-white hover:bg-purple-600 transition'>
                $texto
            </button>
        </a>";
    }

    $conteudoHtml = '';
    if (is_array($conteudos) && !empty($conteudos)) {
        foreach ($conteudos as $item) {
            $conteudoHtml .= "<div class='p-4 bg-gray-800 rounded-lg'>
                <h2 class='text-lg text-white'>{$item['titulo']}</h2>
                <p class='text-gray-400'>{$item['descricao']}</p>
            </div>";
        }
    }

    $html = "<div class='w-full max-w-4xl p-4 sm:py-6 px-0'>
                <h1 class='text-xl sm:text-3xl font-bold text-white'>$titulo</h1>
                <p class='text-gray-400 mb-2'>$subtitulo</p>
                <div class='mb-4 sm:mb-6 flex flex-wrap gap-4'>
                    $botoesHtml
                </div>
                $conteudoHtml
            </div>";

    return $html;
}
?>