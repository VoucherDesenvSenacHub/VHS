<?php
namespace Src\Views\Components\Utils;
 
require "../../components/utils/buttonComponent.php";
require "../../components/utils/inputComponent.php";
           
use function Src\Views\Components\Utils\InputComponent;
 
?>
<title>Criar Conta</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="../../../styles/global.css"></script>
<body>
    
<div class="bg-[#0C0118]  h-full w-full items-center flex justify-between" >
    <div class="flex items-center justify-center h-full ">
        <img class="h-full relative right-[61px] mr-28 w-[1200px] " src="../../../../public/images/Cassete.svg" alt="">
    </div>
    <div class="mx-20  w-1/2 flex items-center justify-center shadow-[ -10px_0_30px_10px_rgba(255, 255, 255, 1)]">
        <div class="flex flex-col gap-4">
            <div class="flex items-center flex-col gap-4">
                <img src="../../../../public/logos/Logo.svg" alt="">
                <p class=" font-pop font-semibold title-size text-3xl text-[#fff]">Redefinir Senha</p>
                <p class=" font-pop paragraph-size text-gray-300">Informe o e-mail sua conta</p>
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