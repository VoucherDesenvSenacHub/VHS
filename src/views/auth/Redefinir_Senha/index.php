<?php

namespace Src\Views\Components\Utils;

require "../../components/utils/buttonComponent.php";
require "../../components/utils/inputComponent.php";

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>

<body class="bg-background h-screen w-screen flex justify-between items-center">
    <div class="flex">
        <div class="flex justify-center mr-24">
            <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-[110px] mr-28 w-[1100px]">
        </div>
        <div class="flex items-center justify-center">
            <div class="flex flex-col gap-2">
                <div class="flex items-center flex-col gap-2">
                    <img src="../../../../public/logos/Logo.svg" alt="">
                    <p class=" font-pop font-semibold title-size text-3xl text-secondary">Redefinir Senha</p>
                    <p class=" font-pop paragraph-size text-gray300">Informe o e-mail sua conta</p>
                </div>
                <div class="flex flex-col gap-4 w-[380px]">
                    <?= InputComponent(placeholder: "Insira seu e-mail", type: "email", label: "Email", icon: "../../../../public/icons/Vector.svg", iconPosition: "right-3") ?>
                    <div>
                        <?= ButtonComponent(text: "Enviar e-mail", variant: "default") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>