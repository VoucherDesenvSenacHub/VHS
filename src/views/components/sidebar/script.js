document.addEventListener("DOMContentLoaded", () => {

    const barrinha = document.getElementById("barrinha");
    const sidebar = document.querySelector(".sidebar");
    const menuTitles = document.querySelectorAll(".menu-titles");

    barrinha.addEventListener("click", () => {

        if (sidebar.classList.contains("hidden")) {
            sidebar.classList.remove("hidden");
            void sidebar.offsetHeight;
            sidebar.classList.remove("opacity-0", "-translate-x-full");
            sidebar.classList.add("opacity-100", "translate-x-0");
        } else {
            sidebar.classList.remove("opacity-100", "translate-x-0");
            sidebar.classList.add("opacity-0", "-translate-x-full");
    
            setTimeout(() => {
                sidebar.classList.add("hidden");
            }, 300);
        }

        if (menuTitles.classList.contains("hidden") && sidebar.classList.contains("flex")) {
            menuTitles.classList.remove("hidden");
        } else [
            men
        ]

    });
});