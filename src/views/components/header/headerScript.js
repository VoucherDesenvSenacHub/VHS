document.addEventListener("DOMContentLoaded", (e) => {

    const search = document.getElementById("search");
    const header = document.getElementById("header");
    const buttonUserMenu = document.getElementById("open-user-menu");
    const userMenu = document.getElementById("user-menu");
    const body = document.body;

    search.addEventListener('click', () => {
        header.classList.toggle('header') ;  
    });

    buttonUserMenu.addEventListener("click", (e) => {
        e.stopPropagation();
        userMenu.classList.remove("hidden");
        void userMenu.offsetWidth;
        
        userMenu.classList.remove("opacity-0");
        userMenu.classList.add("opacity-100");
        userMenu.classList.remove("scale-95");
        userMenu.classList.add("scale-100");
    });

    document.addEventListener("click", (e) => {
        if (!userMenu.contains(e.target) && !buttonUserMenu.contains(e.target)) {
            userMenu.classList.remove("opacity-100");
            userMenu.classList.add("opacity-0");
            userMenu.classList.remove("scale-100");
            userMenu.classList.add("scale-95");

            setTimeout(() => {
                userMenu.classList.add("hidden")
            }, 200);
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