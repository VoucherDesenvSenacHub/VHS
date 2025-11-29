<?php

namespace Src\Views\Components;

require_once __DIR__ . "/../modal/removeFast.component.php";

use function Src\Views\Components\Modal\RemoveFastComponent;

function CardFast(array $data): string
{
    $thumbnail = htmlspecialchars($data['thumbnail_url']);
    $titulo = htmlspecialchars($data['titulo']);
    $likes = htmlspecialchars($data['likes'] ?? '0');
    $views = htmlspecialchars($data['views'] ?? '0');
    $id = htmlspecialchars($data['id']);

    $modalFastRemove = RemoveFastComponent(
        'Remover Fast',
        'Tem certeza que deseja excluir o fast?',
        $id
    );

    return <<<HTML
        <div class='cursor-pointer h-[30rem] md:h-[35rem] relative flex items-center justify-center current_fast rounded-2xl'>
            <img src='{$thumbnail}' class='w-full object-cover h-full absolute rounded-2xl' alt='Imagem do card'>
            <div class='absolute inset-0 bg-gradient-to-t from-black/75 to-transparent rounded-2xl'></div>

            <div class='block w-full bottom-12 absolute px-1 z-10'>
                <h2 class='text-white ml-3.5'>{$titulo}</h2>

                <div class='mt-2 w-full flex gap-4 px-4 absolute'>
                    <div class='flex items-center gap-2.5'>
                        <img src='/VHS/public/icons/fastIcon/Vector.svg' alt='coração'>
                        <p class='text-sm text-white'>{$likes}</p>
                    </div>

                    <div class='flex items-center gap-2.5'>
                        <img src='/VHS/public/icons/fastIcon/eyeIcon.svg' alt='visualizações'>
                        <p class='text-sm text-white'>{$views}</p>
                    </div>

                    
                    <button class='menu-btn absolute right-6'>
                        <img src='/VHS/public/icons/fastIcon/3botao.svg' alt='menu de opções'>
                    </button>

                    <div class='w-[55%] absolute flex flex-col z-10 bg-[#2A2A2C] p-2 text-white bottom-9 right-4 gap-3 rounded-lg hidden menu'>
                        <a href='/VHS/studio/content/fast/edit?id={$id}'>
                            <button
                                class='group flex items-center justify-center gap-2 w-full
                                border border-white/40 rounded-xl py-2 px-4
                                transition-all duration-200 hover:bg-purple-700'
                            >
                                <img src='/VHS/public/icons/pencill.svg'
                                    class='w-4 h-4 transition-all duration-200 group-hover:brightness-0 group-hover:invert' />
                                <span class='transition-all duration-200 text-white'>Editar fast</span>
                            </button>
                        </a>
                        <div class='cursor-pointer remove_fast'>
                            <button
                                class='group flex items-center justify-center gap-2 w-full
                                border border-white/40 text-white/80 rounded-xl py-2 px-4
                                transition-all duration-200 hover:bg-red-600'
                            >
                                <img src='/VHS/public/icons/trash.svg'
                                    class='w-4 h-4 transition-all duration-200 group-hover:brightness-0 group-hover:invert' />
                                <span class='transition-all duration-200 text-white'>Excluir fast</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class='hidden modal_remove_fast'>
                {$modalFastRemove}
            </div>
        </div>
        <script defer src='/VHS/src/views/components/CardFastComponent/cardFast.js'></script>
    HTML;
}
