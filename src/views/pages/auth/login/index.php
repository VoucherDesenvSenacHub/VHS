<?php
$errors = $_SESSION['redirect_data']['errors'] ?? [];
$fields = $_SESSION['redirect_data']['fields'] ?? [];

if (!empty($errors) && is_array($errors)) {
    foreach ($errors as $error) {
        if (str_contains(strtolower($error), 'email') && !str_contains(strtolower($error), 'senha')) {
            $emailError = $error;
        } elseif (str_contains(strtolower($error), 'senha') && !str_contains(strtolower($error), 'email')) {
            $passwordError = $error;
        }
        elseif (str_contains(strtolower($error), 'email') && str_contains(strtolower($error), 'senha')) {
          $emailPasswordError = $error;
        }
        else {
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
          <p class="text-3xl font-semibold text-white max-xl:text-2xl">Entrar na sua conta</p>
          <p class="text-secondary">Informe seus dados para entrar sua conta</p>
        </div>
        <form action="/VHS/src/application/routes/route.php/api/v1/auth/signin" method="POST">
          <div class="flex flex-col gap-4 w-full xl:w-96">
                <?= InputComponent(placeholder: "Insira seu e-mail", name: "email", type: "email", label: "Email", icon: "/VHS/public/icons/Vector.svg", iconPosition: "w-6 h-6 right-3", value: $fields["email"] ?? "", error: !empty($emailError), errorDescription: !empty($emailError) ? $emailError : "") ?>
                <?= InputComponent(placeholder: "Insira sua senha", name: "password", type: "password", label: "Senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3", value: $fields["password"] ?? "", error: !empty($passwordError), errorDescription: !empty($passwordError) ? $passwordError : "") ?>
                <?= !empty($genericError) ? "<p id='genericError' class='text-red-500'>Ocorreu um erro interno. Tente novamente mais tarde!</p>" : '' ?>
                <?= !empty($emailPasswordError) ? "<p id='genericError' class='text-red-500'>Email ou senha incorretos</p>" : '' ?>
                <a class="text-secondary underline" href="/VHS/src/views/pages/auth/new-password">Esqueceu sua senha? </a>
                <?= CheckboxComponent("Lembrar de mim", id: "keep_logged_in") ?>
                <?= ButtonComponent("Acessar Plataforma", "default", className: " g-recaptcha btn-submit mt-4", type: "button", attributes: [
                        "data-sitekey" => "6LeZE6MrAAAAAFW6zL9HUPU8eJ616uwPWu92db9a",
                        "data-callback" => "onSubmit",
                        "data-action" => 'submit',
                        "onClick" => '() => grecaptcha.execute()'
                    ]) ?>

              </div>
              <div class="flex items-center text-white cursor-default">
                <div class="flex-grow border-t border-gray300"></div>
                <span class="px-3 text-sm font-semibold">OU</span>
                <div class="flex-grow border-t border-gray300"></div>
              </div>
          </form>
              <div class="text-black">
                <?= ButtonComponent("Entrar pelo Google", "icon", "/VHS/public/images/LogoGoogle.svg", link: "/VHS/src/views/pages/home") ?>
              </div>
              <div class="flex gap-0.5 items-center justify-center">
                <p class="text-secondary cursor-default">Ainda não tem uma conta?</p>
                <a class="text-primary underline" href="/VHS/src/application/routes/route.php/auth/signup">Cadastrar</a>
              </div>
            </div>
      </div>
    </div>
  </div>
</body>
<script>
  function onSubmit(token) {
    document.querySelector("form").submit();
  }
</script>
</html>