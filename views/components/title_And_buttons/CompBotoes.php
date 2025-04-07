<?php
namespace src\views\components\title_And_buttons;

class CompBotoes {
    public static function render($titulo, $subtitulo, $botoes, $conteudos = []) {
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

        $html = "<div class='flex flex-col md:flex-row min-h-screen mt-10 ml-20'>
            <div class='flex-1 p-4 sm:p-6 md:pt-16'>
                <h1 class='text-xl sm:text-2xl font-bold'>Resultados para: $titulo</h1>
                <p class='text-gray-400 mb-2'>$subtitulo</p>
                
                <div class='mb-4 sm:mb-6 flex space-x-4'>
                    $botoesHtml
                </div>

                <div class='mt-6'>
                    <div class='flex items-center justify-between py-4 border-b border-gray-700/50'>
                        <div class='w-full grid grid-cols-1 sm:grid-cols-2 gap-4'>
                            $conteudoHtml
                        </div>
                    </div>
                </div>
            </div>
        </div>";

        return $html;
    }
}
?>