<?php

require "../../components/utils/inputComponent.php";
require "../../components/utils/buttonComponent.php";
require "../../components/utils/comentary/comentaryComponent.php";
            

use function Src\Views\Components\Utils\Comment;

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

<body class="flex justify-center">
    <div class="flex h-screen w-screen bg-background text-white">
      <?= Comment(name: "João Carlos", text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur at vel iste ea cupiditate tempore exercitationem, dolore mollitia fugiat sit necessitatibus modi repellendus voluptatum obcaecati voluptate incidunt? Architecto, doloremque necessitatibus.")  ?>
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
  }
);
</script>
</body>
</html>