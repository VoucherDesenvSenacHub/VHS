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

<div class="flex p-4 flex-col w-auto h-auto bg-[#1b1b1b] rounded-xl overflow-hidden">
    <div class="flex items-center w-full gap-3 h-auto border-b-2 border-white/10 p-4">
        <div class="rounded-full">
            <img class="w-12 h-12 bg-red-500 rounded-full" src="../../../../public/images/ProfilePhoto.png" alt="">
        </div>

        <div class="flex flex-col h-14 justify-around">
            <p class="font-pop subtitle-size text-[#FFFFFF]">Freitasdev</p>
            <p class="text-[#666]">eu@freitasdev</p>
        </div>
    </div>

    <div class="flex gap-2 flex-col p-4 border-b-2 border-white/10">
        <button class="cursor-pointer flex flex-row items-center text-start gap-2 hover:bg-white/10">
            <div class="p-2">
                <img src="../../../../public/icons/settings.svg" width="30px" height="30px">
            </div>
    
            <div class="flex flex-col">
                <p class="subtitle-size text-white">Minha Conta</p>
                <p class="paragraph-size text-white">Gerencie dados e preferência</p>
            </div>
        </button>
    
        <button class="cursor-pointer flex gap-2 hover:bg-white/10">
            <div>
                <img src="../../../../public/icons/studio.svg" width="30px" height="30px">
            </div>
            
            <div class="flex flex-col">
                <p class="subtitle-size text-white">VHS Studio</p>
                <p class="paragraph-size text-white">Gerencie seu canal</p>
            </div>
        </button>
    
        <button class="cursor-pointer flex gap-2 hover:bg-white/10">
            <div>
                <img src="../../../../public/icons/dashboard.svg" width="30px" height="30px">
            </div>
            
            <div class="flex flex-col">
                <p class="subtitle-size text-white">Dashboard</p>
                <p class="paragraph-size text-white">Gerencie vídeos, usuário e comentário</p>
            </div>
        </button>
    </div>

    <button class="cursor-pointer flex gap-2 hover:bg-white/10" style="padding: 10px;">
        <div>
            <img src="../../../../public/icons/logout.svg" width="30px" height="30px">
        </div>
        
        <div class="flex flex-col">
            <p class="subtitle-size text-[#bc3636]">Sair da conta</p>
        </div>
    </button>
</div>