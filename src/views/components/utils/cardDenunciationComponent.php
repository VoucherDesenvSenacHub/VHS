<?php
namespace Src\Views\Components\Utils;

function cardDenunciationComponent(string $perfil_url, string $contentCreator, string $id, string $userType, int $index = 0) {
    return "
        <div class='flex items-center justify-between'>
            <div class='flex flex-row gap-4'>
                <img class='size-20 rounded-xl' src='$perfil_url' alt=''>
                <div>
                    <p class='text-white'>@$contentCreator</p>
                    <p class='text-gray-400'>$id</p> 
                    <p class='text-gray-400'>$userType</p>
                </div>
            </div>        
            <div class='relative flex size-6 w-12'>
                <button id='btn_cargo_$index' onclick='cargo($index,event)'>
                    <img class='size-10' src='../../../public/icons/Promover-component.svg' alt=''>
                </button>
                
                <button id='btn_ban_$index' onclick='ban($index,event)'>
                    <img class='size-10' src='../../../public/icons/user-block-rounded-svgrepo-com.svg' alt=''>
                </button>

                
                <div id='ban_$index' class='hidden absolute top-8 right-1 z-10 flex flex-col gap-2 bg-gray-900 rounded-lg p-2 w-24 border-[0.5px] border-gray-500'>
                    <div class='flex flex-row gap-1'>
                        <img src='../../../public/icons/time-svgrepo-com.svg' alt='' class='size-6 rotate-[-110deg]'>
                        <p class='text-[13px] flex items-center text-gray-200'>Banir</p>
                    </div>
                </div>


                <div id='cargo_$index' class='hidden absolute top-8 right-6 z-10 flex flex-col gap-2 bg-gray-900 rounded-lg p-2 w-24 border-[0.5px] border-gray-500'>
                    <div class='flex flex-row gap-1'>
                        <img src='../../../public/icons/time-svgrepo-com.svg' alt='' class='size-6 rotate-[-110deg]'>
                        <p class='text-[13px] flex items-center text-gray-200'>Usuário</p>
                    </div>
                    <div class='flex flex-row gap-1'>
                        <img src='../../../public/icons/time-svgrepo-com.svg' class='size-6' alt=''>
                        <p class='text-[13px] flex items-center text-gray-200'>Criador</p>
                    </div>
                    <div class='flex flex-row gap-1'>
                        <img src='../../../public/icons/crown.svg' class='size-6' alt=''>
                        <p class='text-[13px] flex items-center text-gray-200'>Admin</p>
                    </div>
                </div>
            </div>
        </div>";
}
?>