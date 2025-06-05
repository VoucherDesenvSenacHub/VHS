<?php
require "../../src/views/components/utils/buttonComponent.php";
require "../../src/views/components/header/headerComponent.php";
require "../../src/views/components/utils/footer.php";
require "../../src/views/components/barra_lateral/barra_lateral.php";
            



use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\sidebar\SidebarComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\utils\footerComponent;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Syne:wght@400..800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-[#20002c] via-black to-[#20002c] bg-no-repeat bg-cover bg-center">
    <div class="flex flex-col h-screen justify-between"> 
            <header class="">
                <?= HeaderComponent(); ?>
            </header>
            
        <div class="flex flex-row">

            <?= SidebarComponent(); ?>
            <div class="flex-col ml-12 mr-12">

                <div id="Content" class=" flex z-30 ">
                    
                    <div class="relative w-full overflow-hidden z-0 object-contain rounded-2xl mt-12">
                        <!-- Imagem maior -->
                        <img src="../../public/logos/B&W.jpg" class="right-0 h-76 w-screen object-cover" alt="Grande">
                    </div>
                    
                </div>

                <div class="self-cente w-32 h-32 rounded-3xl border border-white/20 overflow-hidden z-10 -mt-12 ml-6">
                     <!-- Imagem menor -->
                   <img src="../../public/logos/BillGates.webp" class="w-full h-full object-cover" alt="Pequena">
                
                </div>

            </div>
                
        </div class="absolute">
        
        <footer id="footer" class="absolute">
            <?= Footer() ?>
            
        </footer>
    </div>
    
</body>
</html>