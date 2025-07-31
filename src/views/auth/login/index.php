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
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../../../styles/tailwindglobal.js"></script>
</head>
<body>
  <div class="flex min-h-screen bg-background text-white xl:justify-start justify-center">
    <div class="flex justify-center mr-24 xl:mr-24 max-xl:hidden">
      <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
    </div>
    <div class="relative xl:min-w-1/2 xl:mx-20 flex items-center justify-center w-full max-w-md xl:max-w-none xl:w-auto px-4 xl:px-0">
      <div class="flex flex-col gap-4">
        <div class="flex items-center flex-col gap-2">
          <img src="../../../../public/logos/Logo.svg" alt="">
          <p class="text-4xl font-pop font-semibold title-size text-white">Entrar na sua conta</p>
          <p class="font-pop paragraph-size text-gray-200">Informe seus dados para entrar sua conta</p>
        </div>
        <div class="flex flex-col gap-4 w-full xl:w-96">
          <?= InputComponent(placeholder: "Insira seu e-mail", type: "email", label: "Email", icon: "../../../../public/icons/Vector.svg", iconPosition: "w-6 h-6 right-3") ?>
          <?= InputComponent(placeholder: "Insira sua senha", type: "password", label: "Senha", icon: "../../../../public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3") ?>
          <div class="flex gap-2">
            <p class="font-pop paragraph-size text-gray-400">Esqueceu a senha?</p>
            <a href="/VHS/src/views/auth/reset_password/index.php" class="font-pop paragraph-size text-purple-500 underline">Redefinir</a>
          </div>
          <div class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" id="checkbox" class="hidden">
            <div id="customCheckbox" class="w-5 h-5 flex items-center justify-center bg-background rounded-md border border-gray300 transition-all">
              <svg id="checkIcon" class="w-4 h-4 text-white hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <span class="cursor-default text-white text-xs font-medium">Lembrar de mim</span>
          </div>
          <div>
            <?= ButtonComponent("Acessar plataforma", "default", null, 23.75, 3.125, null, "/VHS/src/views/pages/home/index.php", true) ?>
          </div>
          <div class="flex items-center text-white cursor-default">
            <div class="flex-grow border-t border-gray300"></div>
            <span class="px-3 text-sm font-semibold">OU</span>
            <div class="flex-grow border-t border-gray300"></div>
          </div>
          <div>
            <?= ButtonComponent("Entrar pelo Google", "google", "../../../../public/images/LogoGoogle.svg", 23.75, 3.125, true) ?>
          </div>
          <div class="flex gap-0.5 items-center justify-center">
            <p class="font-pop paragraph-size text-gray-200 cursor-default">Ainda não tem uma conta?</p>
            <a class="font-pop paragraph-size text-purple-500 underline" href="../register/index.php">Cadastrar</a>
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
      customCheckbox.classList.toggle("border-gray300");
      checkIcon.classList.toggle("hidden");
    });
  </script>
</body>
</html>