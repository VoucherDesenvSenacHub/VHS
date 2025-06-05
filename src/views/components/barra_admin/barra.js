document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const menuTexto = document.getElementsByClassName("menu-text");
    const menuAberto = localStorage.getItem("menuAberto");

    // Define o estado inicial do menu com base no localStorage
    if (menuAberto === "true") {
        body.classList.add("menu");
    }

    // Aplica transições iniciais aos textos do menu
    Array.from(menuTexto).forEach(item => {
        item.style.transition = "opacity 0.3s ease, transform 0.3s ease";
        item.style.opacity = "0";
        item.style.transform = "translateX(-20px)";
    });

    // Função para atualizar a visibilidade do menu
    function atualizarVisibilidadeMenu() {
        if (body.classList.contains("menu")) {
            Array.from(menuTexto).forEach(item => {
                item.style.display = "block";
                setTimeout(() => {
                    item.style.opacity = "1";
                    item.style.transform = "translateX(0)";
                }, 10);
            });
            localStorage.setItem("menuAberto", "true");
        } else {
            Array.from(menuTexto).forEach(item => {
                item.style.opacity = "0";
                item.style.transform = "translateX(-20px)";
                setTimeout(() => {
                    item.style.display = "none";
                }, 300);
            });
            localStorage.setItem("menuAberto", "false");
        }
    }

    // Observador de mudanças na classe do body
    const observer = new MutationObserver(atualizarVisibilidadeMenu);
    observer.observe(body, { attributes: true, attributeFilter: ["class"] });

    // Atualiza a visibilidade do menu inicialmente
    atualizarVisibilidadeMenu();

    // Adiciona evento de clique para alternar o estado do menu
    const items = document.querySelectorAll("li");
    items.forEach(item => {
        item.addEventListener("click", function () {
            items.forEach(el => {
                const icon = el.querySelector(".icon");
                icon.classList.remove("bg-[#660BAD]", "bg-opacity-100");
                icon.classList.add("bg-opacity-10");
                icon.querySelector("img").classList.remove("filter", "invert", "brightness-0");
            });
            const clickedIcon = item.querySelector(".icon");
            clickedIcon.classList.remove("bg-opacity-10");
            clickedIcon.classList.add("bg-[#660BAD]", "bg-opacity-100");
            clickedIcon.querySelector("img").classList.add("filter", "invert", "brightness-0");
        });
    });
});
