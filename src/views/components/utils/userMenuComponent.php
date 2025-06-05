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
            color: var(--secondary);
        }

        .subtitle-size {
            font-size: var(--subtitle-size);
        }

        .paragraph-size {
            font-size: var(--paragraph-size);
        }
    }

</style>

<div class="w-64 h-auto bg-[#1b1b1b] rounded-xl p-4">
    <div class="flex items-center w-full gap-3 h-auto border-b-2 border-white/10">
        <div class="rounded-full">
            <img class="w-12 h-12 bg-red-500 rounded-full" src="../../../../public/images/ProfilePhoto.png" alt="">
        </div>

        <div class="flex flex-col h-14 justify-around">
            <p class="font-pop paragraph-size text-[#FFFFFF]">Freitasdev</p>
            <p class="text-[#666]">eu@freitasdev</p>
        </div>
    </div>

    <div class="flex gap-3 flex-col">
        <div class="flex items-center gap-2">
            <div>
                <img src="../../../../public/icons/settings.svg" alt="">
            </div>
    
            <div class="flex flex-col gap-1">
                <p class="paragraph-size text-white">Minha Conta</p>
                <p class="paragraph-size text-white">Gerencie dados e preferência</p>
            </div>
        </div>
    
        <div class="flex items-center gap-2">
            <div>
                <img src="../../../../public/icons/studio.svg" alt="">
            </div>
            
            <div class="flex flex-col gap-1">
                <p class="paragraph-size text-white">Minha Conta</p>
                <p class="paragraph-size text-white">Gerencie dados e preferência</p>
            </div>
        </div>
    
        <div class="flex items-center gap-2">
            <div>
                <img src="../../../../public/icons/dashboard.svg" alt="">
            </div>
            
            <div class="flex flex-col gap-1">
                <p class="paragraph-size text-white">Minha Conta</p>
                <p class="paragraph-size text-white">Gerencie dados e preferência</p>
            </div>
        </div>
    </div>
</div>