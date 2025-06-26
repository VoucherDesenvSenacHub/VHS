<?php
namespace Src\Views\Components;

function CardFast(array $data): string {
    $thumbnail = htmlspecialchars($data['thumbnail_url']);
    $titulo = htmlspecialchars($data['titulo']);
    $likes = htmlspecialchars($data['likes'] ?? '0');
    $views = htmlspecialchars($data['views'] ?? '0');

    return "
        <div class='w-64 h-[30rem] relative flex items-center justify-center current_fast rounded-2xl'>
            <img src='{$thumbnail}' class='object-cover h-full absolute rounded-2xl' alt='Imagem do card'>

            <div class='block w-full bottom-12 absolute px-1'>
                <h2 class='text-white ml-3.5'>{$titulo}</h2>

                <div class='mt-2 w-full flex justify-around absolute'>
                    <div class='flex items-center gap-2.5'>
                        <img src='/VHS/public/icons/fastIcon/Vector.svg' alt='coração'>
                        <p class='text-sm text-white'>{$likes}</p>
                    </div>

                    <div class='flex items-center gap-2.5'>
                        <img src='/VHS/public/icons/fastIcon/eyeIcon.svg' alt='visualizações'>
                        <p class='text-sm text-white'>{$views}</p>
                    </div>

                    
                    <button class='menu-btn'>
                        <img src='/VHS/public/icons/fastIcon/3botao.svg' alt='menu de opções'>
                    </button>

                    <div class='top-6 menu w-40 h-16 bg-gray-800 rounded-md flex items-center justify-center border-[0.1rem] border-solid border-gray-600 
                        top-0 ml-5 absolute hidden'>
                        <ul class='w-full flex flex-col'>  

                            <li class='hover:bg-gray-700 text-white font-semibold flex items-center w-full h-8 text-xs gap-2'>
                                <img src='/VHS/public/icons/cardFast/Pen.svg'>
                                <p >Editar título</p>   
                            </li>

                            <li class='hover:bg-gray-700 text-white font-semibold flex w-full h-8 text-xs gap-2 items-center'>
                                <img src='/VHS/public/icons/cardFast/trash.svg'>
                                <p >Excluir</p>
                            </li>
                        </ul>    
                    </div>

                </div>
            </div>
        </div>

        
    ";
}
