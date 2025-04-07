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
    <title>reset_password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>

<body>
    <div class="flex h-screen bg-background text-white">
        <div class="flex justify-center mr-24">
            <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
        </div>

      <div class="relative mx-20 w-1/2 flex items-center justify-center shadow-[-10px_0_30px_10px_rgba(255, 255, 255, 1)]">
        <div class="flex flex-col gap-4">
            <div class="flex items-center flex-col gap-2">
                <img src="../../../../public/logos/Logo.svg" alt="">
                <p class="text-4xl font-pop font-semibold title-size text-white">Redefenir Senha</p>
                <p class="font-pop paragraph-size text-gray-200">Informe o e-mail da sua conta</p>
            </div>
            <div class="flex flex-col gap-4 w-96">
                <?= InputComponent(placeholder:"Insira seu e-mail", type:"email", label:"E-mail", icon:"../../../../public/icons/Vector.svg",iconPosition: "w-6 h-6 right-3") ?>
                        <?= ButtonComponent(text: "Enviar e-mail", variant: "default") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>