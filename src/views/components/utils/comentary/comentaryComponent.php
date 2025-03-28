<?php

namespace Src\Views\Components\Utils;

function Comment(string $userImg, string $name, string $text, string $created_at) {
    return (
        "
        <div class='max-w-96 h-28 block flex'>

            <div class='w-10 h-11 rounded-full mt-1'>
                <img class='w-full h-full rounded-full' src=$userImg alt=''>
            </div>

            <div class='block ml-3'>

                <div class='max-w-80 h-5 flex items-baseline'>
                    <p class='text-sm text-white font-semibold'>$name</p> 
                    <p class='text-xs text-gray-300 font-semibold ml-1'>há 5 dias</p>
                </div>

                <div class='max-w-xs h-20 mt-1 text-xs font-semibold text-gray-400'>
                    <p>$text</p>
                </div>

            </div>

            <div class='size-20 ml-9 mt-2 cursor-pointer relative' id='3botao'>
                <img src='/Voucher-dev-142-VHS/public/icons/ellipsis-vertical.svg' alt='3_botao'>
            <div>
        </div>
        <div class='w-16 h-14 bg-gray-800 rounded-[0.22rem] flex items-center justify-center  border-[0.1rem] border-solid border-gray-600  top-[-0.56rem] ml-1 absolute  hidden' id='menu'>
            <ul class='w-full'>  
                <li class=' hover:bg-gray-700 text-white font-semibold flex justify-center items-center  w-14 h-5 text-xs m-auto'>

                    <div>
                        <img src='trash.svg' alt=
                        ''>
                    </div>
                    <div class='ml-1'>
                        <p>Excluir</p>
                    </div>
                </li>
                <li class=' hover:bg-gray-700 text-white font-semibold flex justify-center items-center w-14 h-5 text-xs m-auto'>
                    <div>
                        <img src='pen.svg' alt=''>
                    </div>
                    <div class='ml-1'>
                        <p>Editar</p>
                    </div>
                </li>
                
            </ul>    
        </div>

        "
    );
}
