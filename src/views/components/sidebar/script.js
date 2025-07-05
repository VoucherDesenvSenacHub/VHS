document.addEventListener("DOMContentLoaded", () => {
    
    const barrinha = document.getElementById("barrinha");
    const sidebar = document.querySelector(".sidebar");
    const menuTitles = document.querySelectorAll(".menu-titles");

    const isDesktop = window.matchMedia("(min-width: 640px)").matches;
    let isExpanded = false;

    barrinha.addEventListener("click", () => {
        if (!isDesktop) {
            const isHidden = sidebar.classList.contains("hidden");
            
            if (isHidden) {
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
        } else {
            isExpanded = !isExpanded;

            if (isExpanded) {
                sidebar.classList.add("w-[12rem]");
                sidebar.classList.remove("w-[4rem]");
            } else {
                sidebar.classList.add("w-[4rem]");
                sidebar.classList.remove("w-[12rem]");
            }

            menuTitles.forEach(title => {
                if (isExpanded) {
                    title.classList.remove("hidden");
                } else {
                    title.classList.add("hidden");
                }
            });
        }
    });
    
});