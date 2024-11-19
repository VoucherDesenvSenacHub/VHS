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
                require "../../../components/utils/input.component.php";
                require "../../../components/utils/input.style.php";
                
                use function Src\Components\Utils\inputComponent;
                use function Src\Components\Utils\inputStyle;
                
                inputStyle();
                inputComponent(null,null,"E-mail","Insira seu email",null);
                inputComponent(null,null,"Senha","Insira seu email",null);
                
                ?>
        
            <div class="config">
                <p>Esqueceu a senha?</p>
                <a href="">Redefinir</a>
            </div>
            
            <div class="config">
                <input type="checkbox" id="checkbox">
                <p>Lembrar de mim</p>
            </div>

            <?php
                require "../../../components/utils/button.component.php";
                require "../../../components/utils/button.style.php";
                
                use function Src\Components\Utils\buttonComponent;
                use function Src\Components\Utils\buttonStyle;
            
                buttonStyle();
                buttonComponent(null,"Acessar plataforma",null);
                buttonComponent(null,"Entrar pelo Google","../../../../public/logos/logo-google.png");

                ?>

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