document.addEventListener('DOMContentLoaded', () => {
    const titles = document.querySelectorAll(".title");
    const texts = document.querySelectorAll(".menu-text");
    const toggleButton = document.querySelector("#barrinha");
    const sidebar = document.querySelector("aside");
    const icons = document.querySelectorAll(".icon");
    const separator = document.querySelector(".separator");

    if (!sidebar || !toggleButton) {
        console.error("Sidebar or toggle button not found");
        return;
    }

    const isMobile = window.innerWidth < 768;
    let isExpanded = !isMobile;

    sidebar.style.transition = "width 0.3s ease, padding 0.3s ease";
    sidebar.style.overflow = "hidden";

    // Initial state
    if (isMobile) {
        sidebar.style.width = "0";
        sidebar.style.padding = "0";
        sidebar.style.position = "fixed";

        if (separator) separator.style.display = "none";
    }

    texts.forEach(text => {
        text.style.display = "inline-block";
        text.style.transition = "opacity 0.3s ease, transform 0.3s ease";
        text.style.whiteSpace = "nowrap";
    });

    const url = window.location.href;
    if (url.includes("minimized")) {
        toggleSidebar(false);
    }

    function checkRoute() {
        if (icons.length === 0) return;

        const urlSplit = url.split("/home");

        if (icons[0]) icons[0].classList.toggle("active", url.includes("/home") && (urlSplit.at(-1) === "/" || urlSplit.at(-1) === ""));
        if (icons[1]) icons[1].classList.toggle("active", url.includes("/home/fasts"));
        if (icons[2]) icons[2].classList.toggle("active", url.includes("/home/events"));

        // Check categories if they exist in icons list
        if (icons.length > 3) {
            icons.forEach((icon, index) => {
                if (index > 2) {
                    const link = icon.parentElement.getAttribute('href');
                    if (link && url.includes(link)) {
                        icon.classList.add('active');
                    }
                }
            });
        }
    }
    checkRoute();

    function toggleSidebar(state) {
        isExpanded = state !== undefined ? state : !isExpanded;
        const isMobileNow = window.innerWidth < 768;

        if (isMobileNow) {
            sidebar.style.width = isExpanded ? "100%" : "0";
            sidebar.style.position = isExpanded ? "fixed" : "sticky";
            sidebar.style.zIndex = "50";
            sidebar.style.marginTop = "5rem";
            sidebar.style.position = "fixed";
            sidebar.style.height = "100vh";
            sidebar.style.top = "0";
            sidebar.style.padding = isExpanded ? "1.75rem" : "0";
            sidebar.style.backgroundColor = "#100018"; // Enforce background on mobile
            document.body.style.overflow = isExpanded ? "hidden" : "auto";
            if (separator) separator.style.display = isExpanded ? "block" : "none";
        } else {
            sidebar.style.width = isExpanded ? "16rem" : "5.5rem";
            sidebar.style.position = "sticky";
            sidebar.style.height = "91vh";
            sidebar.style.top = "4rem";
            sidebar.style.padding = "1.75rem";
            sidebar.style.backgroundColor = ""; // Reset to CSS value on desktop
            if (separator) {
                separator.style.display = "block";
                separator.style.width = isExpanded ? "auto" : "2rem";
            }
        }

        titles.forEach(title => {
            title.style.display = isExpanded ? "block" : "none";
        });

        texts.forEach(text => {
            if (isExpanded) {
                text.style.opacity = "1";
                text.style.transform = "translateX(0)";
                return;
            }

            text.style.opacity = "0";
            text.style.transform = "translateX(-10px)";
        });
    }

    toggleButton.addEventListener("click", () => {
        toggleSidebar();
    });

    // Handle resize
    window.addEventListener('resize', () => {
        const isMobileNow = window.innerWidth < 768;
        // Reset to desktop state if moving from mobile to desktop
        if (!isMobileNow) {
            if (sidebar.style.position === "fixed") {
                sidebar.style.position = "sticky";
                sidebar.style.height = "91vh";
                sidebar.style.top = "4rem";
                sidebar.style.zIndex = "10";
            }
            if (sidebar.style.width === "0px" || sidebar.style.width === "100%") {
                toggleSidebar(true);
            }
        } else {
            // Moving to mobile
            if (sidebar.style.width !== "0px" && sidebar.style.width !== "100%") {
                toggleSidebar(false);
            }
        }
    });
});

function CategoriesON(event) {
    const button = event.currentTarget;
    const image = button.querySelector('img');
    const title = button.querySelector('h3');

    const wrapper = document.getElementById("categories-wrapper");
    const list = document.getElementById("categories-list");

    if (!wrapper || !list) {
        console.error("Erro: Wrapper ou lista de categorias não encontrados.");
        return;
    }

    const isOpen = wrapper.classList.contains('grid-rows-[1fr]');

    if (isOpen) {
        image.classList.remove('active');
        image.src = "/VHS/public/icons/GridOff.svg";

        title.classList.remove('text-white');
        title.classList.add('hover:text-secondary');

        wrapper.classList.remove('grid-rows-[1fr]');
        wrapper.classList.add('grid-rows-[0fr]');
    } else {
        image.classList.add('active');
        image.src = "/VHS/public/icons/GridOn.svg";

        title.classList.add('text-white');
        title.classList.remove('hover:text-secondary');

        wrapper.classList.remove('grid-rows-[0fr]');
        wrapper.classList.add('grid-rows-[1fr]');

        setTimeout(() => {
            if (wrapper.classList.contains('grid-rows-[1fr]')) {
                list.classList.add('max-h-80', 'overflow-y-auto', 'pr-2');
            }
        }, 50);
    }
}