<?php
namespace Src\Views\Components\Utils;

require "../../components/utils/buttonComponent.php";
require "../../components/utils/inputComponent.php";
           
use function Src\Views\Components\Utils\InputComponent;
?>

<title>register2</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="../../../styles/tailwindglobal.js"></script>

<body>
<div class="flex h-screen bg-background text-white">
    <div class="flex justify-center mr-24">
      <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
    </div>
      <div class="mx-20  w-1/2 flex items-center justify-center shadow-[-10px_0_30px_10px_rgba(255, 255, 255, 1)]">
          <div class="flex flex-col gap-4">
              <div class="flex items-center flex-col gap-2">
                  <img src="../../../../public/logos/Logo.svg" alt="">
                  <p class=" font-pop font-semibold text-3xl text-secondary">Quase lá!</p>
                  <p class=" font-pop paragraph-size text-gray-200">Informe sua senha para criar sua conta!</p>
              </div>
              <div class="flex flex-col gap-4 w-96">
                  <?= InputComponent(placeholder:"Insira sua senha", type:"password", label:"Senha", icon:"../../../../public/icons/eyeOff.svg",iconPosition: "right-3") ?>
                  <?= InputComponent(placeholder:"Confirme sua senha", type:"password", label:"Confirmar senha", icon:"../../../../public/icons/eyeOff.svg",iconPosition: "right-3") ?>
                  <div class="mt-3">
                    <a href="../email_verification/index.php">
                      <?= ButtonComponent("Continuar", "default") ?>
                    </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>
        
<script>
  const checkbox = document.getElementById("checkbox");
  const customCheckbox = document.getElementById("customCheckbox");
  const checkIcon = document.getElementById("checkIcon");

  customCheckbox.addEventListener("click", () => {
  checkbox.checked = !checkbox.checked;
  customCheckbox.classList.toggle("bg-primary");
  customCheckbox.classList.toggle("border-gray600");
  checkIcon.classList.toggle("hidden");
  }
);
</script>
     

