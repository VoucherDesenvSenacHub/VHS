<?php
require "../../src/views/components/utils/buttonComponent.php";
require "../../src/views/components/header/headerComponent.php";
require "../../src/views/components/utils/footer.php";
require "../../src/views/components/barra_lateral/barra_lateral.php";
            



use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\sidebar\SidebarComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\utils\footerComponent;

$dados = [
    ['texto' => 'Microsoft', 
    'link1' => 'https://www.microsoft.com/pt-br', 
    'link2' => 'https://www.instagram.com/microsoft/', 
    'link3' => 'https://www.office.com/'],
    ['Seguidores' => '4.5k', 'tipo' => 'Parceiro']

];




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

                <div class="r w-42 h-42 rounded-4xl border border-white/20 overflow-hidden absolute -mt-24 ml-6 flex flex-row">
                     <!-- Imagem menor -->
                   <img src="../../public/logos/BillGates.webp" class="w-full h-full object-cover " alt="Pequena">
                   
                </div>

                <div class="flex flex-row justify-between ml-52 self-start">
                    
                    <div>
                        <h1 class="p-0 text-white font-bold text-2xl"><?= $dados[0]['texto'] ; ?></h1>
                        
                        <div class=" flex flex-row">

                            <p class="p-0 text-gray-300">
                                <?= $dados[1]['Seguidores']?> Seguidores | <p class="ml-1 p-0 text-white"><?= $dados[1]['tipo'] ?></p>
                            </p>
                            
                        </div>
                    </div>
                    <div class="mt-1">
                        <button> <?= ButtonComponent('Seguir','outline', null, "160px", "35px")?> </button>
                    </div>
                </div>

                    <div class="flex flex-row justify-between">

                        <div class="w-2/4 mt-12">
                            <p class="text-gray-300 text-xl">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed lobortis urna. Suspendisse suscipit lorem in accumsan venenatis. Nunc iaculis vitae orci sed consequat. Suspendisse semper dolor urna, et dictum sem egestas egestas. Mauris dapibus aliquet neque, sit amet sodales lectus vehicula ac. Nulla non est quis tortor aliquam mollis eu et sem. Nullam tempus volutpat vestibulum. Nam porttitor fermentum est nec dapibus. Nulla cursus ante purus, at posuere justo venenatis sed. Etiam lacinia quam vitae mauris tincidunt ultricies. Maecenas ipsum dolor, blandit a sem </p>                  
                            
                        </div>
                        <table class="text-white mt-5 border-separate border-spacing-6 ">
                            <tr>
                                <td><img src="../../public/icons/Union.svg" alt=""></td>
                                <td><a class="text-cyan-500" href=""><?= $dados[0]['link1']?></a></td>
                            </tr>
                            <tr>
                                <td><img src="../../public/icons/Vector1.svg" alt=""></td>
                                <td><a class="text-cyan-500" href=""><?= $dados[0]['link2']?></a></td>
                            </tr>
                            <tr>
                                <td><img src="../../public/icons/World.svg" alt=""></td>
                                <td><a class="text-cyan-500" href=""><?= $dados[0]['link3']?></a></td>
                            </tr>
                        </table>
                        
                    </div>

                    <div class="mt-12">
                        <div>

                            <div>
                                
                                <h1 class="p-0 text-white font-bold text-2xl">Conteúdo do Canal</h1>
                                <p class="p-0 text-gray-300">Confira os vídeo mais populares da nossa plataforma VHS</p>
                                
                            </div>

                            

                        </div>
                    </div>

            </div>
                
        </div class="absolute">
        
        <footer id="footer" class="">
            <?= Footer() ?>
            
        </footer>
    </div>
    
</body>
</html>