document.addEventListener("DOMContentLoaded", (e) => {

    const body = document.body;
    const buttonUserMenu = document.getElementById("open-user-menu");
    const userMenu = document.getElementById("user-menu");
    
    const search = document.getElementById("search");
    const header = document.getElementById("header");
    
    search.addEventListener('click', () => {
        header.classList.toggle('header') ;  
    });

    buttonUserMenu.addEventListener("click", (e) => {
        e.stopPropagation();
        userMenu.classList.remove("hidden");
        void userMenu.offsetWidth;
        
        userMenu.classList.remove("translate-y-full", "opacity-0", "scale-95");
        userMenu.classList.add("translate-y-0", "opacity-100", "scale-100");
    });

    document.addEventListener("click", (e) => {
        if (menuOpen && !userMenu.contains(e.target)) {
            userMenu.classList.remove("opacity-100", "translate-y-0", "scale-100");
            userMenu.classList.add("opacity-0", "translate-y-full", "scale-95");
            
            setTimeout(() => {
                userMenu.classList.add("hidden");
            }, 300);

            menuOpen = false;
        }
    });

    document.getElementById('button-myaccount').addEventListener('click', () => {
        window.location.href = '#';
    });

    document.getElementById('button-vhs-studio').addEventListener('click', () => {
        window.location.href = '#';
    });

    document.getElementById('button-dashboard').addEventListener('click', () => {
        window.location.href = '#';
    });

    document.getElementById('button-logout').addEventListener('click', () => {
        window.location.href = '#';
    });

});