<!-- H T M L -->

<div id="user-menu" class="hidden opacity-0 fixed max-w-sm mx-auto flex flex-col h-auto bg-[#1b1b1b] rounded-2xl overflow-hidden shadow-lg shadow-black/50 transition-all duration-300 fade-in-out scale-95">
    <div class="flex gap-3 items-center w-full border-b-[1px] border-gray300 p-4 hover:bg-white/5 transition-all duration-200">
        <div class="flex-shrink-0 w-12 h-12 sm:w-14 sm:h-14 2xl:w-14 2xl:h-14 rounded-full bg-white/10 overflow-hidden">
            <img class="select-none pointer-events-none w-full h-full object-cover" src="../../../../public/images/ProfilePhoto.png" onerror="this.style.display='none'">
        </div>

        <div class="flex gap-1 flex-col justify-around flex-grow overflow-hidden text-start">
            <h3 class="select-none truncate sm:text-subtitle xl:text-paragraph 2xl:text-subtitle text-secondary">Freitasdev</h3>
            <h2 class="select-none truncate sm:text-paragraph xl:text-caption 2xl:text-paragraph text-gray200">eu@freitasdev</h2>
        </div>
    </div>
    
    <div class="flex flex-col border-b-[1px] border-gray300">
        <button id="button-myaccount" class="flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200">
            <div class="flex-shrink-0 sm:w-14 sm:h-14 xl:w-12 xl:h-12 2xl:w-14 2xl:h-14 p-3 flex justify-center items-center">
                <img class="select-none pointer-events-none w-full h-full" src="../../../../public/icons/settings.svg" onerror="this.style.display='none'">
            </div>

            <div class="flex flex-col text-start pr-4 overflow-hidden">
                <h2 class="select-none truncate sm:text-subtitle xl:text-paragraph 2xl:text-subtitle text-secondary">Minha conta</h2>
                <p class="select-none truncate sm:text-paragraph xl:text-caption 2xl:text-paragraph text-gray300">Gerencie dados e preferências</p>
            </div>
        </button>

        <button id="button-vhs-studio" class="flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200">
            <div class="flex-shrink-0 sm:w-14 sm:h-14 xl:w-12 xl:h-12 2xl:w-14 2xl:h-14 p-3 flex justify-center items-center">
                <img class="select-none pointer-events-none w-full h-full" src="../../../../public/icons/studio.svg" onerror="this.style.display='none'">
            </div>

            <div class="flex flex-col text-start pr-4 overflow-hidden">
                <h2 class="select-none truncate sm:text-subtitle xl:text-paragraph 2xl:text-subtitle text-secondary">VHS Studio</h2>
                <p class="select-none truncate sm:text-paragraph xl:text-caption 2xl:text-paragraph text-gray300">Gerencie o seu canal</p>
            </div>
        </button>

        <button id="button-dashboard" class="flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200">
            <div class="flex-shrink-0 sm:w-14 sm:h-14 xl:w-12 xl:h-12 2xl:w-14 2xl:h-14 p-3 flex justify-center items-center">
                <img class="select-none pointer-events-none w-full h-full" src="../../../../public/icons/dashboard.svg" onerror="this.style.display='none'">
            </div>

            <div class="flex flex-col text-start pr-4 overflow-hidden">
                <h2 class="select-none truncate sm:text-subtitle xl:text-paragraph 2xl:text-subtitle text-secondary">Dashboard</h2>
                <p class="select-none truncate sm:text-paragraph xl:text-caption 2xl:text-paragraph text-gray300">Gerencie seu usuário e mais</p>
            </div>
        </button>
    </div>

    <button id="button-logout" class="flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200">
        <div class="flex-shrink-0 sm:w-14 sm:h-14 xl:w-12 xl:h-12 2xl:w-14 2xl:h-14 p-3 flex justify-center items-center">
            <img class="select-none pointer-events-none w-full h-full" src="../../../../public/icons/logout.svg" onerror="this.style.display='none'">
        </div>

        <div class="flex flex-col pr-4 overflow-hidden">
            <h2 class="select-none truncate sm:text-subtitle xl:text-paragraph 2xl:text-subtitle text-[#bc3636]">Sair da conta</h2>
        </div>
    </button>
</div>

<!-- S C R I P T -->

<script>
    const buttonUserMenu = document.getElementById("open-user-menu")
    const userMenu = document.getElementById("user-menu")

    buttonUserMenu.addEventListener("click", (e) => {
        e.stopPropagation()
        userMenu.classList.remove("hidden")
        void userMenu.offsetWidth;

        userMenu.classList.remove("opacity-0")
        userMenu.classList.add("opacity-100")

        userMenu.classList.remove("scale-95")
        userMenu.classList.add("scale-100")
    })

    document.addEventListener("click", (e) => {
        if (!userMenu.contains(e.target)) {
            userMenu.classList.remove("opacity-100")
            userMenu.classList.add("opacity-0")

            userMenu.classList.remove("scale-100")
            userMenu.classList.add("scale-95")

            setTimeout(() => {
                userMenu.classList.add("hidden")
            }, 200)
        }
    })
    
    document.getElementById('button-myaccount').addEventListener('click', () => {
        window.location.href = '#'
    })

    document.getElementById('button-vhs-studio').addEventListener('click', () => {
        window.location.href = '#'
    })

    document.getElementById('button-dashboard').addEventListener('click', () => {
        window.location.href = '#'
    })

    document.getElementById('button-logout').addEventListener('click', () => {
        window.location.href = '../../auth/login/index.php'
    })
</script>