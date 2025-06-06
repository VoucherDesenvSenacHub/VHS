<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>userMenuComponent</title>

    <link rel="stylesheet" href="../../../styles/global.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">

        @theme { 
            --text-pop: 'Poppins';
            --title-size: 2rem;
            --subtitle-size: 1.5rem;
            --paragraph-size: 1rem;

            --primary: #6C00C0;
            --secondary: #fff;

            --gray-200: #C4C4C4;
            --gray-300: #666;
            --gray-600: #1B1B1B;
        }

        @layer utilities {
            .font-pop {
                font-family: var(--text-pop);
            }

            .title-size {
                font-size: var(--title-size);
            }
            
            .subtitle-size {
                font-size: var(--subtitle-size);
            }
            
            .paragraph-size {
                font-size: var(--paragraph-size);
                color: var(--gray-300);
            }
        }

    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-[#0C0118]">

    <div class="flex p-4 flex-col w-auto h-auto bg-[#1b1b1b] rounded-2xl overflow-hidden">
        <div class="flex items-center w-full gap-3 h-auto border-b-2 border-white/10 p-4" style="padding: 20px;">
            <div class="rounded-full">
                <img class="w-12 h-12 bg-red-500 rounded-full object-cover" src="../../../../public/images/ProfilePhoto.png">
            </div>

            <div class="flex flex-col h-14 justify-around">
                <p class="font-pop subtitle-size text-[#FFFFFF]">Freitasdev</p>
                <p class="text-[#666]">eu@freitasdev</p>
            </div>
        </div>

        <div class="flex gap-2 flex-col p-4 border-b-2 border-white/10">
            <button class="cursor-pointer flex flex-row items-center text-start gap-2 hover:bg-white/10 transition-all durarion-300">
                <div class="flex justify-center items-center w-14 h-10">
                    <img src="../../../../public/icons/settings.svg" width="30px" height="30px">
                </div>
        
                <div class="flex flex-col text-start">
                    <p class="subtitle-size text-white">Minha Conta</p>
                    <p class="paragraph-size text-white">Gerencie dados e preferência</p>
                </div>
            </button>
        
            <button class="cursor-pointer flex gap-2 hover:bg-white/10 transition-all durarion-300" style="padding: 10px;">
                <div class="flex justify-center items-center w-14 h-10">
                    <img src="../../../../public/icons/studio.svg" width="30px" height="30px">
                </div>
                
                <div class="flex flex-col text-start">
                    <p class="subtitle-size text-white">VHS Studio</p>
                    <p class="paragraph-size text-white">Gerencie seu canal</p>
                </div>
            </button>
        
            <button class="cursor-pointer flex gap-2 hover:bg-white/10 transition-all durarion-300" style="padding: 10px;">
                <div class="flex justify-center items-center w-14 h-10">
                    <img src="../../../../public/icons/dashboard.svg" width="30px" height="30px">
                </div>
                
                <div class="flex flex-col text-start">
                    <p class="subtitle-size text-white">Dashboard</p>
                    <p class="paragraph-size text-white">Gerencie vídeos, usuário e comentário</p>
                </div>
            </button>
        </div>

        <button class="cursor-pointer flex gap-2 hover:bg-white/10 transition-all durarion-300" style="padding: 10px;">
            <div class="flex justify-center items-center w-12 h-12">
                <img src="../../../../public/icons/logout.svg" width="30px" height="30px">
            </div>
            
            <div class="flex flex-col">
                <p class="subtitle-size text-[#bc3636]">Sair da conta</p>
            </div>
        </button>
    </div>

</body>
</html>