<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#0C0118',
                        primary: "#6C00C0",
                        secondary: "#fff",
                        gray200: "#C4C4C4",
                        gray300: "#666",
                        gray600: "#1B1B1B"
                    }
                }
            }
        }   
    </script>
</head>

    <div class="flex w-100 h-screen bg-background  text-white " id="wrapper">
        <div class="flex justify-center mr-24">
            <img src="../../../../public/images/Cassete.svg" alt="" class="h-full relative right-[61px] mr-28 w-[1200px]">
        </div>
        <div class="flex jusfity-center mt-24 h-full flex-col w-1/2 h-full ">    
            <div class="flex mt-20 ml-20 mb-5">
                <img src="../../../../public/logos/Logo.svg" alt="Logo">
            </div>
            
            <div class="">
                <h2 class="flex ml-10 mt-0.7rem text-3xl font-semibold text-secondary">Entrar na sua conta</h2>
                <p class="text-gray200 flex ml-3 mb-2 mt-2">Informe seus dados para entrar em sua conta</p>
            </div>

            <div class="flex flex-row gap-0.5rem mt-0.7rem ">
                <p>Esqueceu a senha?</p>
                <u class="text-primary" href="">Redefinir</u>
            </div>
            
            <div class="w-1rem  flex gap-1 ">   
                <input type="checkbox" class="flex " id="checkbox">
                <p>Lembrar de mim</p>
            </div>

            <div class="flex flex-row  items-center gap-0.4rem m-1.5 rem 0 1.5rem 0">
                <hr>
                <p>OU</p>
                <hr>
            </div>

            
            <div class="flex  flex-row gap-0.5rem mt-0.7rem ">
                <p>Ainda não tem uma conta?</p>
                <u class="text-primary">Cadastrar</u>
            </div>
        </div>
    </div>

</body>

</html>