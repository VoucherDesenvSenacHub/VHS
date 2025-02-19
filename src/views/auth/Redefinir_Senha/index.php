<?php
namespace Src\Views\Components\Utils;
 
require "../../components/utils/buttonComponent.php";
require "../../components/utils/inputComponent.php";
           
use function Src\Views\Components\Utils\InputComponent;
 
?>
<title>Criar Conta</title>
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
<style type="text/tailwindcss">
  @theme {
       
    --text-pop: 'Poppins', sans-serif;
 
    --primary: #6C00C0;
    --secondary: #fff;
 
    --gray-200: #C4C4C4;
    --gray-300: #666;
    --gray-600: #1B1B1B;
 
    --title-size: 2rem;
    --subtitle-size: 1.5rem;
    --paragraph-size: 1rem;
  }
 
      @layer utilities {
    .font-pop {
      font-family: var(--text-pop);
    }
 
    .title-size {
      font-size: var(--title-size);
    }
 
    .subtitle-size {
      font-size: var(--subtitle-size);
    }
 
    .paragraph-size {
      font-size: var(--paragraph-size);
    }
  }
</style>
<body>
    
<div class="bg-[#0C0118]  h-full w-full items-center flex justify-between" >
    <div class="flex items-center justify-center h-full ">
        <img class="h-full relative right-[61px] mr-28 w-[1200px] " src="../../../../public/images/Cassete.svg" alt="">
    </div>
    <div class="mx-20  w-1/2 flex items-center justify-center shadow-[ -10px_0_30px_10px_rgba(255, 255, 255, 1)]">
        <div class="flex flex-col gap-4">
            <div class="flex items-center flex-col gap-4">
                <img src="../../../../public/logos/Logo.svg" alt="">
                <p class=" font-pop font-semibold title-size text-[#fff]">Redefinir Senha</p>
                <p class=" font-pop paragraph-size text-gray-200">Informe o e-mail sua conta</p>
            </div>
            <div class="flex flex-col gap-4 w-[380px]">
                <?= InputComponent(placeholder:"Insira seu e-mail", type:"email", label:"Email", icon:"../../../../public/icons/Vector.svg",iconPosition: "right-3") ?>
                <div>
                  <?= ButtonComponent("Continuar", "default") ?>
                </div>
                <div class="flex items-center text-white cursor-default">
                  
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>