<?php
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/utils/sweetalert.php";

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Application\Utils\showSweetAlert;

$step = $_GET["step"] ?? 1;

if ($step == 1) {
    $render = InputComponent(name: "email", placeholder: "Seu e-mail", type: "email");
} else {
    $token = $_GET['token'] ?? '';
    $render = 
    "<input type='hidden' name='token' value='$token'>" .
    InputComponent(name: "password", placeholder: "Insira sua senha nova", type: "password", label: "Senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3") .
    InputComponent(name: "confirm_password", placeholder: "Confirme nova senha", type: "password", label: "Confirme sua senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Redefinir senha</title>
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
                    <h2 class="text-3xl font-semibold title-size text-white max-xl:text-2xl">Redefenir senha</h2>
                    <p class="text-secondary text-center">
                        <?= $step == 1 ? "Insira o e-mail da sua conta" : "Insira sua nova senha da sua conta" ?>
                    </p>
                </div>
                <form class="flex flex-col gap-4 w-full xl:w-96" action="<?= $step == 1 ? '/VHS/api/v1/auth/reset-password' : '/VHS/api/v1/auth/new-password' ?>" method="post">
                    <?= $render ?>
                    <?= ButtonComponent($step == 1 ? "Enviar e-mail" : "Redefinir", "default", className: " mt-4", link: $step == "1" ? "?step=2" : "/VHS/home"); ?>
                </form>
                <a class="text-secondary underline" href="/VHS/auth/signin">Voltar para login</a>
            </div>
        </div>
    </div>  
    <?php
        if(isset($_SESSION['redirect_data']['success'])) {
            echo showSweetAlert('Successo!', $_SESSION['redirect_data']['success'], 'success');
            unset($_SESSION['redirect_data']['success']);
        }

        if(isset($_SESSION['redirect_data']['error'])) {
            echo showSweetAlert('Ocorreu um problema!', $_SESSION['redirect_data']['error'], 'error');
            unset($_SESSION['redirect_data']['error']);
        }
    ?>
</body>
</html>