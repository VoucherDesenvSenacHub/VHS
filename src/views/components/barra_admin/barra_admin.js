document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const sideMenu = document.querySelector("#sideMenuContainer aside");
    const menutexto = document.getElementsByClassName("menu-text");


    function updateMenuVisibility() {
        if (body.classList.contains("menu")) {
            for (let i=0; i < menutexto.length; i++){
                menutexto[i].style.setProperty("display", "block", "important");
            };

        } else {

            for (let i=0; i < menutexto.length; i++){
                menutexto[i].style.setProperty("display", "none", "important");
                
            };
        }



    }

    updateMenuVisibility();

    const observer = new MutationObserver(updateMenuVisibility);
    observer.observe(body, { attributes: true, attributeFilter: ["class"] });

    const items = document.querySelectorAll("li");
    const barraLateral = {

        "analytcs.php": "analytics-icon",

        "usuarios.php": "usuarios-icon",
        
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