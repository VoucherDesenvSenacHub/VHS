<?php
require "../../components/utils/inputComponent.php";
require "../../components/utils/buttonComponent.php";
require "../../components/checkbox/checkboxComponent.php";


use function App\Views\Components\CheckboxComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VHS - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/VHS/src/styles/tailwindglobal.js"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>
<body>
  <div class="flex min-h-screen text-white xl:justify-start justify-center max-w-[1920px] mx-auto">
    <div class="flex justify-center mr-24 xl:mr-24 max-xl:hidden">
      <img src="/VHS/public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
    </div>
    <div class="relative xl:min-w-1/2 xl:mx-20 flex items-center justify-center w-full max-w-md xl:max-w-none xl:w-auto px-4 xl:px-0">
      <div class="flex flex-col gap-4">
        <div class="flex items-center flex-col gap-2">
          <img src="/VHS/public/logos/Logo.svg" alt="">
          <p class="text-4xl font-pop font-semibold title-size text-white max-xl:text-3xl">Entrar na sua conta</p>
          <p class="font-pop paragraph-size text-gray-200">Informe seus dados para entrar sua conta</p>
        </div>
        <div class="flex flex-col gap-4 w-full xl:w-96">
          <?= InputComponent(placeholder: "Insira seu e-mail", type: "email", label: "Email", icon: "/VHS/public/icons/Vector.svg", iconPosition: "w-6 h-6 right-3") ?>
          <?= InputComponent(placeholder: "Insira sua senha", type: "password", label: "Senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3") ?>
        <?= CheckboxComponent("Lembrar de mim") ?>
          <?= ButtonComponent("Acessar plataforma", "default") ?>
          </div>
          <div class="flex items-center text-white cursor-default">
            <div class="flex-grow border-t border-gray300"></div>
            <span class="px-3 text-sm font-semibold">OU</span>
            <div class="flex-grow border-t border-gray300"></div>
          </div>
          <div class="text-black">
            <?= ButtonComponent("Entrar pelo Google", "icon", "/VHS/public/images/LogoGoogle.svg") ?>
          </div>
          <div class="flex gap-0.5 items-center justify-center">
            <p class="font-pop paragraph-size text-secondary cursor-default">Ainda não tem uma conta?</p>
            <a class="font-pop paragraph-size text-primary underline" href="./register">Cadastrar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>