<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../styles/global.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <div id="wrapper">
        <img src="../../../../public/images/Cassete.svg" alt="" class="cassete">
        <div class="data-control">    
            <div class="logo">
                <img src="../../../../public/logos/logo-vhs.svg" alt="">
            </div>
            
            <div class="data">
                <h2>Entrar na sua conta</h2>
                <p>Informe seus dados para entrar em sua conta</p>
            </div>
            
            <?php
            require "../../components/utils/inputComponent.php";
            
            use function Src\Views\Components\Utils\inputComponent;
            
            echo inputComponent(placeholder: "Teste", type: "text");
            ?>
        
            <div class="config">
                <p>Esqueceu a senha?</p>
                <a href="">Redefinir</a>
            </div>
            
            <div class="config top">
                <input type="checkbox" id="checkbox">
                <p>Lembrar de mim</p>
            </div>

            <div class="or">
                <hr>
                <p>OU</p>
                <hr>
            </div>
            
            <div class="config">
                <p>Ainda não tem uma conta?</p>
                <a href="">Cadastrar</a>
            </div>
            </div>
            
        </div>
    </div>

</body>

</html>