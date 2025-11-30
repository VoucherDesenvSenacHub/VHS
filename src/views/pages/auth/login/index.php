<?php
$errors = $_SESSION['redirect_data']['errors'] ?? [];
$fields = $_SESSION['redirect_data']['fields'] ?? [];

if (!empty($errors) && is_array($errors)) {
  foreach ($errors as $error) {
    if (str_contains(strtolower($error), 'email') && !str_contains(strtolower($error), 'senha')) {
      $emailError = $error;
    } elseif (str_contains(strtolower($error), 'senha') && !str_contains(strtolower($error), 'email')) {
      $passwordError = $error;
    } elseif (str_contains(strtolower($error), 'email') && str_contains(strtolower($error), 'senha')) {
      $emailPasswordError = $error;
    } else {
      $genericError = $error;
    }
  }
}
unset($_SESSION['redirect_data']);

require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/checkbox/checkboxComponent.php";
require_once __DIR__ . "/../../../../application/utils/redirect.php";

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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/VHS/src/styles/tailwindglobal.js"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="bg-gradient-to-b from-[#100018] to-black min-h-screen font-[Poppins] overflow-x-hidden">
  <div class="flex min-h-screen text-white xl:justify-start justify-center mx-auto relative">


    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
      <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-[#660BAD]/20 rounded-full blur-[120px]"></div>
      <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-[#660BAD]/10 rounded-full blur-[120px]"></div>
    </div>

    <div class="flex justify-center items-center mr-24 xl:mr-24 max-xl:hidden z-10 w-1/2">
      <img src="/VHS/public/images/Cassete.svg" alt="" class="w-full max-w-[600px] drop-shadow-[0_0_50px_rgba(102,11,173,0.3)] animate-float">
    </div>

    <div class="relative xl:min-w-1/2 xl:mx-20 flex items-center justify-center w-full max-w-[35rem] xl:w-auto px-4 xl:px-0 z-10">
      <div class="flex flex-col gap-6 w-full p-8 rounded-3xl border border-white/5 bg-white/[0.02] backdrop-blur-xl shadow-2xl">
        <div class="flex items-center flex-col gap-3 mb-2">
          <img src="/VHS/public/logos/Logo.svg" alt="" class="h-12 w-auto mb-2">
          <h1 class="text-3xl font-bold text-white tracking-tight">Bem-vindo de volta!</h1>
          <p class="text-gray-400 text-center text-sm">Informe seus dados para acessar sua conta</p>
        </div>

        <form action="/VHS/src/application/routes/route.php/api/v1/auth/signin" method="POST">
          <div class="flex flex-col gap-5 w-full">
            <?= InputComponent(
              placeholder: "seu@email.com",
              name: "email",
              type: "email",
              label: "Email",
              icon: "/VHS/public/icons/Vector.svg",
              iconPosition: "right",
              value: $fields["email"] ?? "",
              error: !empty($emailError),
              errorDescription: !empty($emailError) ? $emailError : ""
            ) ?>

            <div class="flex flex-col gap-1">
              <?= InputComponent(
                placeholder: "Sua senha secreta",
                name: "password",
                type: "password",
                label: "Senha",
                icon: "/VHS/public/icons/eyeOff.svg",
                iconPosition: "right",
                value: $fields["password"] ?? "",
                error: !empty($passwordError),
                errorDescription: !empty($passwordError) ? $passwordError : ""
              ) ?>
              <div class="flex justify-end mt-1">
                <a class="text-[#660BAD] hover:text-[#8a2be2] transition-colors font-medium" href="/VHS/src/views/pages/auth/new-password">Esqueceu sua senha?</a>
              </div>
            </div>

            <?= !empty($genericError) ? "<div class='p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-500 text-sm text-center'>Ocorreu um erro interno. Tente novamente mais tarde!</div>" : '' ?>
            <?= !empty($emailPasswordError) ? "<div class='p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-500 text-sm text-center'>Email ou senha incorretos</div>" : '' ?>

            <div class="flex items-center relative top-8">
              <?= CheckboxComponent(label: "Lembrar de mim", id: "keep_logged_in") ?>
            </div>

            <?= ButtonComponent(text: "Acessar Plataforma", variant: "default", className: "w-full py-3.5 text-base font-semibold shadow-lg shadow-purple-900/20 hover:shadow-purple-900/40 transition-all duration-300 g-recaptcha btn-submit mt-2", type: "button", attributes: [
              "data-sitekey" => "6LeZE6MrAAAAAFW6zL9HUPU8eJ616uwPWu92db9a",
              "data-callback" => "onSubmit",
              "data-action" => 'submit',
              "onClick" => '() => grecaptcha.execute()'
            ]) ?>

            <p class="text-[10px] text-gray-500 text-center leading-tight opacity-60">
              Este site é protegido pelo reCAPTCHA e aplicam-se a
              <a href="https://policies.google.com/privacy" target="_blank" class="text-[#660BAD] hover:underline">Política de Privacidade</a> e os
              <a href="https://policies.google.com/terms" target="_blank" class="text-[#660BAD] hover:underline">Termos de Serviço</a> do Google.
            </p>

          </div>
        </form>

        <div class="flex gap-1.5 items-center justify-center mt-2">
          <p class="text-gray-400 text-sm">Ainda não tem uma conta?</p>
          <a class="text-[#660BAD] hover:text-[#8a2be2] font-semibold text-sm transition-colors" href="/VHS/auth/signup">Criar conta</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function onSubmit(token) {
      document.querySelector("form").submit();
    }
  </script>
  <style>
    .grecaptcha-badge {
      visibility: hidden;
    }

    @keyframes float {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .animate-float {
      animation: float 6s ease-in-out infinite;
    }
  </style>
</body>

</html>