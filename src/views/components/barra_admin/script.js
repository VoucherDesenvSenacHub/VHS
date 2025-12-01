document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector("#barrinha");
    const sidebar = document.querySelector("#admin-sidebar");

    if (!sidebar || !toggleButton) {
        console.error("Admin Sidebar or toggle button not found");
        return;
    }

    const getTextElements = () => sidebar.querySelectorAll("span.font-medium");
    const textElements = getTextElements();

    let isExpanded = window.innerWidth >= 768;

    // Initial setup
    if (window.innerWidth < 768) {
        sidebar.style.width = "0px";
        sidebar.style.position = "fixed";
        sidebar.style.zIndex = "50";
        sidebar.style.height = "100vh";
        sidebar.style.top = "0";
        sidebar.style.marginTop = "5rem";
    }

    function toggleSidebar(state) {
        if (state !== undefined) {
            isExpanded = state;
        } else {
            isExpanded = !isExpanded;
        }

        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            if (isExpanded) {
                sidebar.style.width = "100%";
                sidebar.style.padding = "0";
                sidebar.style.backgroundColor = "#0C0118";
            } else {
                sidebar.style.width = "0px";
                sidebar.style.padding = "0";
            }
            sidebar.style.position = "fixed";
            sidebar.style.height = "calc(100vh - 5rem)";
            sidebar.style.top = "5rem";
            sidebar.style.marginTop = "0";
        } else {
            sidebar.style.width = isExpanded ? "16rem" : "5.5rem";
            sidebar.style.position = "sticky";
            sidebar.style.top = "0";
            sidebar.style.height = "100vh";
            sidebar.style.padding = "0";
            sidebar.style.backgroundColor = "";
        }

        textElements.forEach(text => {
            if (isExpanded) {
                text.style.display = "block";
                setTimeout(() => text.style.opacity = "1", 50);
            } else {
                if (isMobile) {
                    return;
                }
                text.style.opacity = "0";
                setTimeout(() => text.style.display = "none", 300);
            }
        });

        const title = sidebar.querySelector("h2");
        if (title && !isMobile) title.style.display = isExpanded ? "block" : "none";

        // Handle "Voltar para VHS" text
        const backLink = sidebar.querySelector(".border-t a span");
        if (backLink && !isMobile) {
            backLink.style.display = isExpanded ? "block" : "none";
            backLink.style.opacity = isExpanded ? "1" : "0";
        }
    }

    toggleButton.addEventListener("click", (e) => {
        e.stopPropagation();
        toggleSidebar();
    });

    document.addEventListener("click", (e) => {
        const isMobile = window.innerWidth < 768;
        if (isMobile && isExpanded && !sidebar.contains(e.target) && !toggleButton.contains(e.target)) {
            toggleSidebar(false);
        }
    });

    window.addEventListener('resize', () => {
        const isMobile = window.innerWidth < 768;
        if (!isMobile) {
            sidebar.style.position = "sticky";
            sidebar.style.width = "16rem";
            sidebar.style.zIndex = "50";
            sidebar.style.backgroundColor = "";
            isExpanded = true;
            textElements.forEach(t => {
                t.style.display = "block";
                t.style.opacity = "1";
            });
            const title = sidebar.querySelector("h2");
            if (title) title.style.display = "block";
            const backLink = sidebar.querySelector(".border-t a span");
            if (backLink) {
                backLink.style.display = "block";
                backLink.style.opacity = "1";
            }
        } else {
            sidebar.style.position = "fixed";
            sidebar.style.width = "0px";
            isExpanded = false;
        }
    });
});
