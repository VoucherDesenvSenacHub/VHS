<?php
namespace Src\Views\Components\Utils;

require "../../components/utils/buttonComponent.php";
require "../../components/utils/inputComponent.php";
           
use function Src\Views\Components\Utils\InputComponent;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>

<body>
    <div class="flex w-100 h-screen bg-background text-white">
        <div class="flex justify-center mr-24">
            <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-[61px] mr-28 w-[1392px]">
        </div>

      <div class="relative mx-20 w-1/2 flex items-center justify-center shadow-[ -10px_0_30px_10px_rgba(255, 255, 255, 1)]">
        <div class="flex flex-col gap-4">
            <div class="flex items-center flex-col gap-2">
                <img src="../../../../public/logos/Logo.svg" alt="">
                <p class="text-[33px] font-pop font-semibold title-size text-[#fff]">Criar sua Conta</p>
                <p class="font-pop paragraph-size text-gray-200">Informe seus dados para criar sua conta</p>
            </div>
            <div class="flex flex-col gap-4 w-96">
                <?= InputComponent(placeholder:"Insira seu e-mail", type:"email", label:"Email", icon:"../../../../public/icons/Vector.svg",iconPosition: "w-6 h-6 right-3") ?>
                <?= InputComponent(placeholder:"Insira sua senha", type:"password", label:"Senha", icon:"../../../../public/icons/eye-svgrepo.svg",iconPosition: "w-6 h-6 right-3") ?>
                <?= InputComponent(placeholder:"Confirme sua senha", type:"password", label:"Confirmar senha", icon:"../../../../public/icons/eye-svgrepo.svg",iconPosition: "w-6 h-6 right-3") ?>
                <div class="flex items-center space-x-2 cursor-pointer">
                  <input type="checkbox" id="checkbox" class="hidden">
                  <div id="customCheckbox" class="w-5 h-5 flex items-center justify-center bg-[#0C0118] rounded-md border border-[#666666] transition-all">
                      <svg id="checkIcon" class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                      </svg>
                  </div>
                  <span class="cursor-default text-white text-xs font-medium">Lembrar de mim</span>
                </div>
                <div>
                <?= ButtonComponent("Criar Conta", "default") ?>
                </div>
                <div class="flex items-center text-white cursor-default">
                  <div class="flex-grow border-t border-[#666666]"></div>
                  <span class="px-3 text-sm font-semibold">OU</span>
                  <div class="flex-grow border-t border-[#666666]"></div>
                </div>
                <div class="text-black">
                  <?= ButtonComponent("Criar conta pelo Google", "icon", "../../../../public/images/LogoGoogle.svg" ) ?>
                </div>
                <div class="flex gap-[2px] items-center justify-center">
                  <p class="font-pop paragraph-size text-gray-200 cursor-default" >Já possui uma conta?</p>
                  <a class="font-pop paragraph-size text-[#660BAD] underline" href="#">Entrar</a>
                </div>
            </div>
        </div>
    </div>
</div>
        
<script>
  const checkbox = document.getElementById("checkbox");
  const customCheckbox = document.getElementById("customCheckbox");
  const checkIcon = document.getElementById("checkIcon");

  customCheckbox.addEventListener("click", () => {
  checkbox.checked = !checkbox.checked;
  customCheckbox.classList.toggle("bg-purple-700");
  customCheckbox.classList.toggle("border-[#666666]");
  checkIcon.classList.toggle("hidden");
  }
);
</script>
</body>
</html>
