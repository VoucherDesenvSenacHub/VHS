document.addEventListener("DOMContentLoaded", function() {
    const menuTexts = document.querySelectorAll("#sidebar .menu-text");
    const toggleButton = document.querySelector("#barrinha");
    const menuItems = document.querySelectorAll("#sidebar ul li a");
    const sidebar = document.querySelector("#sidebar");

    let isExpanded = true;

    // Configurações iniciais para os textos do menu
    menuTexts.forEach(text => {
        text.style.display = "inline-block";
        text.style.transition = "opacity 0.3s ease, transform 0.3s ease";
        text.style.whiteSpace = "nowrap";
    });

    // Lógica de ativação de itens (mantida do original)
    function setActiveItem(href) {
        menuItems.forEach(item => {
            const button = item.querySelector("button");
            button.classList.remove("bg-[#660BAD]");
            if (item.getAttribute("href") === href) {
                button.classList.add("bg-[#660BAD]");
            }
        });
        localStorage.setItem("activeItem", href);
    }

    const activeItem = localStorage.getItem("activeItem");
    if (activeItem) {
        setActiveItem(activeItem);
    }

    menuItems.forEach(item => {
        item.addEventListener("click", function() {
            const href = item.getAttribute("href");
            setActiveItem(href);
        });
    });

    // Função para mostrar/esconder apenas os textos
    function toggleSidebar(state) {
        isExpanded = state !== undefined ? state : !isExpanded;

        sidebar.style.width = isExpanded ? "9.3rem" : "5.35rem";

        menuTexts.forEach(text => {
            if (isExpanded) {
                text.style.opacity = "1";
                text.style.transform = "translateX(0)";
            } else {
                text.style.opacity = "0";
                text.style.transform = "translateX(-10px)";
            }
        });
    }

    // Verifica URL para minimizar automaticamente
    const url = window.location.href;
    if (url.includes("minimized")) {
        toggleSidebar(false);
    }

    // Evento do botão de toggle
    if (toggleButton) {
        toggleButton.addEventListener("click", () => {
            toggleSidebar();
        });
    }
});