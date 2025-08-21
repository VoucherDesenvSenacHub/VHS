<?php
require "../../../components/utils/inputComponent.php";
require "../../../components/utils/buttonComponent.php";

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;

$step = $_GET["step"] ?? 1;

if ($step === 1) {
    $render = InputComponent(placeholder: "Seu e-mail", type: "email");
if ($step === "1") {
    $render = '
        <div class="flex flex-col gap-1">
            '.InputComponent(placeholder: "Seu e-mail", type: "email").'
            <p class="text-red-500 text-sm hidden" id="emailError">Campo vazio</p>
        </div>
    ';
} else {
    $render = '
        <div class="flex flex-col gap-1">
            '.InputComponent(placeholder: "Insira sua senha nova", type: "password", label: "Senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3").'
            <p class="text-red-500 text-sm hidden" id="senhaError">Campo vazio</p>
        </div>
        <div class="flex flex-col gap-1">
            '.InputComponent(placeholder: "Confirme nova senha", type: "password", label: "Confirme sua senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3").'
            <p class="text-red-500 text-sm hidden" id="confirmaError">Campo vazio</p>
        </div>
    ';
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
                        <?= $step == 1 ? "Insira o e-mail da sua conta" : "Insira a nova senha da sua conta" ?>
                    </p>
                </div>
                <form id="resetForm" class="flex flex-col gap-4 w-full xl:w-96" method="POST" action="<?= $step == '1' ? '?step=2' : '/VHS/src/views/pages/auth/login/index.php' ?>">
                    <?= $render ?>
                    <?= ButtonComponent($step == 1 ? "Enviar e-mail" : "Confirmar", "default", className: " mt-4"); ?>
                </form>
            </div>
        </div>
    </div>

    <div id="successAlert" class="overflow-hidden fixed flex bottom-0 right-0 mb-4 mr-4 min-w-20 min-h-10 bg-[#202024] rounded-xl items-center p-4 gap-4 border-b-4 border-[#660BAD] translate-y-5 opacity-0 transition-all duration-300">
        <div class="w-12 h-12 bg-[#373450] rounded-full flex items-center justify-center p-2" style="box-shadow: 0 0 75px 0 #660BAD;">
            <svg width="100%" height="100%" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.704 5.292a1 1 0 00-1.408 0L8 12.586 4.704 9.292a1 1 0 00-1.408 1.416l4 4a1 1 0 001.416 0l8-8a1 1 0 000-1.416z" fill="#22c55e"/>
            </svg>
        </div>
        <div class="flex flex-col text-white">
            <h1 class="title text-xl">Senha redefinida com sucesso!!</h1>
            <span class="subtitle text-gray-500 text-base">Sua senha foi alterada corretamente</span>
        </div>
    </div>

    <script>
        const form = document.getElementById("resetForm");
        const successAlert = document.getElementById("successAlert");

        form.addEventListener("submit", function (e) {
            let step = "<?= $step ?>";
            let inputs = form.querySelectorAll("input");
            let valid = true;

            document.querySelectorAll("p.text-red-500").forEach(p => p.classList.add("hidden"));

            if (step === "1") {
                let email = inputs[0].value.trim();
                let emailError = document.getElementById("emailError");
                if (email === "") {
                    emailError.textContent = "Campo vazio";
                    emailError.classList.remove("hidden");
                    valid = false;
                } else {
                    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!regex.test(email)) {
                        emailError.textContent = "Insira um e-mail válido";
                        emailError.classList.remove("hidden");
                        valid = false;
                    }
                }
            } else {
                let senha = inputs[0].value.trim();
                let confirma = inputs[1].value.trim();

                let senhaError = document.getElementById("senhaError");
                let confirmaError = document.getElementById("confirmaError");

                senhaError.classList.add("hidden");
                confirmaError.classList.add("hidden");

                if (senha === "" || confirma === "") {
                    senhaError.textContent = "Campo vazio!";
                    confirmaError.textContent = "Campo vazio!";
                    senhaError.classList.remove("hidden");
                    confirmaError.classList.remove("hidden");
                    valid = false;
                } else if (senha.length < 6 || confirma.length < 6) {
                    senhaError.textContent = "A senha deve ter pelo menos 6 caracteres!";
                    confirmaError.textContent = "A senha deve ter pelo menos 6 caracteres!";
                    senhaError.classList.remove("hidden");
                    confirmaError.classList.remove("hidden");
                    valid = false;
                } else if (senha !== confirma) {
                    senhaError.textContent = "As senhas não estão iguais!";
                    confirmaError.textContent = "As senhas não estão iguais!";
                    senhaError.classList.remove("hidden");
                    confirmaError.classList.remove("hidden");
                    valid = false;
                }
            }

            if (!valid) {
                e.preventDefault();
            } else if (step !== "1") {
                e.preventDefault();
                
                successAlert.classList.remove("opacity-0", "translate-y-5");
                successAlert.classList.add("opacity-100", "translate-y-0");

                setTimeout(() => {
                    successAlert.classList.remove("opacity-100", "translate-y-0");
                    successAlert.classList.add("opacity-0", "translate-y-5");
                    setTimeout(() => {
                        window.location.href = "/VHS/src/views/pages/auth/login/index.php";
                    }, 300);
                }, 2000);
            }
        });
    </script>
</body>
</html>
