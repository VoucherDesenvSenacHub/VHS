<?php
   namespace Src\Views\Components\Utils;

   function UserMenuComponent( string $nomeUsuario, string $emailUsuario, string $descricaoUsuario, string $fotoDePerfil){
      return(
        "<div class='w-72 divide-y-1 divide-[#666666] h-auto bg-[#1b1b1b] rounded-xl'>
          <div class='flex items-center w-full gap-4 h-auto p-4'>
            <div class='rounded-full'>
              <img class='w-12 h-12 bg-red-500 rounded-full' src='$fotoDePerfil' alt='Foto de Perfil'>
            </div>
            <div class='h-14'>
              <p class='font-pop paragraph-size text-[#FFFFFF]'>$nomeUsuario</p>
              <p class='text-[#666] truncate w-40'>$emailUsuario</p>
              <p class='font-pop text-xs text-[#C4C4C4]'>$descricaoUsuario</p>
            </div>
          </div>
          <div class='flex flex-col justify-center gap-4 p-4'>
            <div class='flex items-center gap-2'>
              <div>
                <img class='w-6 h-6' src='../../../../public/icons/Settings.svg' alt=''>
              </div>
              <div >
                <p class='font-pop paragraph-size text-[#FFFFFF]'>Minha Conta</p>
                <p class='font-pop text-xs text-[#666]'>Gerencie dados e preferência</p>
              </div>
            </div>
            <div class='flex items-center gap-2'>
              <div>
                <img class='w-6 h-6' src='../../../../public/icons/Studioo.svg' alt=''>
              </div>
              <div >
                <p class='font-pop paragraph-size text-[#FFFFFF]'>VSH Studio</p>
                <p class='font-pop text-xs text-[#666]'>Gerencie seu canal</p>
              </div>
            </div>
            <div class='flex items-center gap-2'>
              <div>
                <img class='w-8 h-8' src='../../../../public/icons/Dashboardd.svg' alt=''>
              </div>
              <div >
                <p class='font-pop paragraph-size text-[#FFFFFF]'>Dashboard</p>
                <p class='font-pop text-xs text-[#666]'>Gerencie os vídeos da plataforma, usuário e comentários</p>
              </div>
            </div>
          </div>
          <div class='flex items-center gap-2 p-4'>
            <div>
              <img class='w-6 h-6' src='../../../../public/icons/exit.svg' alt=''>
            </div>
            <div>
              <p class='font-pop paragraph-size text-[#BC3636]'>Sair da conta</p>
            </div>
          </div>
        </div>"
      );
   }
?>
