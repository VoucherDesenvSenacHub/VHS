<?php

namespace Src\Views\Components\Utils;

require __DIR__ . "/../../../components/utils/buttonComponent.php";
require __DIR__ . "/../../../components/utils/inputComponent.php";
require __DIR__ . "/../../../components/checkbox/checkboxComponent.php";

use function App\Views\Components\CheckboxComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;

$errors = $_SESSION["redirect_data"]["errors"] ?? [];
$fields = $_SESSION["redirect_data"]["fields"] ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="bg-gradient-to-b from-[#100018] to-black min-h-screen font-[Poppins] overflow-x-hidden">
    <div class="flex min-h-screen text-white xl:justify-start justify-center mx-auto relative">

        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-[#660BAD]/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-[#660BAD]/10 rounded-full blur-[120px]"></div>
        </div>

        <div class="flex justify-center items-center mr-24 xl:mr-24 max-xl:hidden z-10 w-1/2">
            <img src="/VHS/public/images/Cassete.svg" alt="" class="w-[60%] max-w-[600px] drop-shadow-[0_0_50px_rgba(102,11,173,0.3)] animate-float">
        </div>
        <div class="relative xl:min-w-1/2 xl:mx-20 flex items-center justify-center w-full max-w-[35rem] px-4 xl:px-0 z-10">
            <div class="flex flex-col gap-6 w-full p-8 rounded-3xl border border-white/5 bg-white/[0.02] backdrop-blur-xl shadow-2xl">
                <div class="flex items-center flex-col gap-3 mb-2">
                    <img src="/VHS/public/logos/Logo.svg" alt="" class="h-12 w-auto mb-2">
                    <h2 class="text-3xl font-bold text-white tracking-tight text-center">Crie sua conta</h2>
                    <p class="text-gray-400 text-center text-sm">Junte-se à comunidade VHS hoje mesmo</p>
                </div>

                <form class="flex flex-col gap-5 w-full" method="POST" action="/VHS/src/application/routes/route.php/api/v1/auth/signup">
                    <?= InputComponent(
                        placeholder: "Seu nome completo",
                        type: "text",
                        label: "Nome",
                        icon: "/VHS/public/icons/userRound.svg",
                        iconPosition: "right",
                        name: "name",
                        error: isset($errors["name"]),
                        errorDescription: isset($errors["name"]) ? $errors["name"] : "",
                        value: isset($fields["name"]) ? $fields["name"] : ""
                    )
                    ?>
                    <?= InputComponent(
                        placeholder: "Escolha um usuário",
                        type: "text",
                        label: "Usuário",
                        icon: "/VHS/public/icons/userRound.svg",
                        iconPosition: "right",
                        name: "username",
                        error: isset($errors["username"]),
                        errorDescription: isset($errors["username"]) ? $errors["username"] : "",
                        value: isset($fields["username"]) ? $fields["username"] : ""
                    )
                    ?>
                    <?= InputComponent(
                        placeholder: "seu@email.com",
                        type: "email",
                        label: "Email",
                        icon: "/VHS/public/icons/mail.svg",
                        iconPosition: "right",
                        name: "email",
                        error: isset($errors["email"]),
                        errorDescription: isset($errors["email"]) ? $errors["email"] : "",
                        value: isset($fields["email"]) ? $fields["email"] : ""
                    )
                    ?>
                    <?= InputComponent(
                        placeholder: "Data de nascimento",
                        type: "date",
                        label: "Data de nascimento",
                        name: "date_birthday",
                        error: isset($errors["date_birthday"]),
                        errorDescription: isset($errors["date_birthday"]) ? $errors["date_birthday"] : "",
                        value: isset($_POST["date_birthday"]) ? $_POST["date_birthday"] : ""
                    )
                    ?>

                    <div class="flex items-center">
                        <?= CheckboxComponent("Aceito os termos de uso", id: "keep_logged_in") ?>
                    </div>

                    <div>
                        <?= ButtonComponent("Criar Conta", "default", "w-full py-3.5 text-base font-semibold shadow-lg shadow-purple-900/20 hover:shadow-purple-900/40 transition-all duration-300") ?>
                    </div>

                    <div class="flex gap-1.5 items-center justify-center mt-2">
                        <p class="text-gray-400 text-sm">Já possui uma conta?</p>
                        <a class="text-[#660BAD] hover:text-[#8a2be2] font-semibold text-sm transition-colors" href="/VHS/auth/signin">Entrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
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