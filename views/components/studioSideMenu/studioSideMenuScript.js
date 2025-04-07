document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const sideMenu = document.querySelector("#sideMenuContainer aside");

    sideMenu.style.transition = "opacity 0.3s ease, transform 0.3s ease";
    sideMenu.style.opacity = "0";
    sideMenu.style.transform = "translateX(-20px)";

    function updateMenuVisibility() {
        if (body.classList.contains("menu")) {
            sideMenu.style.setProperty("display", "block", "important");
            setTimeout(() => {
                sideMenu.style.opacity = "1";
                sideMenu.style.transform = "translateX(0)";
            }, 10);
        } else {
            sideMenu.style.opacity = "0";
            sideMenu.style.transform = "translateX(-20px)";
            setTimeout(() => {
                sideMenu.style.setProperty("display", "none", "important");
            }, 300); 
        }
    }

    updateMenuVisibility();

    const observer = new MutationObserver(updateMenuVisibility);
    observer.observe(body, { attributes: true, attributeFilter: ["class"] });

    const items = document.querySelectorAll("li");
    const barraLateral = {
        "Inicio.php": "home-icon",
        "Fast.php": "fast-icon",
        "Eventos.php": "eventos-icon",
        "Historico.php": "historico-icon",
        "Tecnologia.php": "tecnologia-icon",
        "Saude.php": "saude-icon",
        "Moda.php": "moda-icon",
        "Estetica.php": "estetica-icon"
    };

    for (const barra in barraLateral) {
        if (location.pathname.includes(barra)) {
            const element = document.querySelector(`.${barraLateral[barra]}`);
            if (element) {
                element.classList.remove("bg-opacity-10");
                element.classList.add("bg-[#660BAD]", "bg-opacity-100");
                element.querySelector("img").classList.add("filter", "invert", "brightness-0");
            }
        }
    }

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