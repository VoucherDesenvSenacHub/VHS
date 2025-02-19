<?php

require "../../components/utils/inputComponent.php";
require "../../components/utils/buttonComponent.php";
            
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#0C0118',
                        primary: "#6C00C0",
                        secondary: "#fff",
                        gray200: "#C4C4C4",
                        gray300: "#666",
                        gray600: "#1B1B1B"
                    }
                }
            }
        }   
    </script>
</head>

<div class="flex w-100 h-screen bg-background  text-white " id="wrapper">
        <div class="flex justify-center mr-24">
            <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-[110px] mr-28 w-[1100px]">
        </div>

        <div class="flex mt-24  flex-col ">    
            <div class="flex mt-20 ml-24 mb-5">
                <img src="../../../../public/logos/Logo.svg" alt="Logo">
            </div>

            <div class="">
                <h2 class="flex ml-10 mt-0.7rem text-3xl font-semibold text-secondary">Entrar na sua conta</h2>
                <p class="text-gray200 flex ml-3 mb-2 mt-2">Informe seus dados para entrar em sua conta</p>

            </div>

            <div class="mb-5">
                <?= InputComponent(placeholder:"Insira seu e-mail", type:"email", label:"Email", icon:"../../../../public/images/E-mail.svg",iconPosition: "right-3") ?>
            </div>

            <div class="mb-5">
                <?= InputComponent(placeholder:"Insira sua senha", type:"password", label:"Senha", icon:"../../../../public/images/eye.svg", iconPosition: "right-3") ?>
            </div>


            <div class="flex flex-row gap-0.5rem mt-0.7rem ">
                <p class="text-gray200">Esqueceu a senha?</p>
                <a class="text-primary ml-2 underline" href="">Redefinir</a>
            </div>

            <div class="flex items-center mt-2 cursor-pointer">
                      <input type="checkbox" id="checkbox" class="hidden">
                      <div id="customCheckbox" class="w-5 h-5 flex items-center justify-center bg-[#0C0118] rounded-md border border-[#666666] transition-all">
                          <svg id="checkIcon" class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                          </svg>
                      </div>
                <span class="text-white text-xs font-7 ml-2">Lembrar de mim</span>
            </div>

            <div class="mt-3">
                <?= ButtonComponent("Acessar Plataforma", "default") ?>
            </div>

            <div class="flex mt-4 mb-4 items-center text-white">
                <div class="flex-grow border-t border-[#666666]"></div>
                    <span class="px-3 text-sm font-semibold">OU</span>
                <div class="flex-grow border-t border-[#666666]"></div>
            </div>

            <div class="text-black">
                <?= ButtonComponent("Entrar pelo Google", "icon", "../../../../public/images/LogoGoogle.svg" ) ?>
            </div>

            <div class="flex bt-4 mt-3 justify-center">
                <p>Ainda não tem uma conta?</p>
                <a class="text-primary ml-2 underline">Cadastrar</a>
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
        });
    </script>

</html>