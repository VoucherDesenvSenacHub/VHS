document.addEventListener("DOMContentLoaded", function () {

    const body = document.body;

    const adminTitle = document.querySelector(".admin-title");

    const menutexto = document.getElementsByClassName("menu-text"); //
 

    if (adminTitle) {

        adminTitle.style.transition = "opacity 0.3s ease, transform 0.3s ease";

        adminTitle.style.opacity = "0";

        adminTitle.style.transform = "translateX(-20px)";

    }
 
    for (let i = 0; i < menutexto.length; i++) {

        menutexto[i].style.transition = "opacity 0.3s ease, transform 0.3s ease";

        menutexto[i].style.opacity = "0";

        menutexto[i].style.transform = "translateX(-20px)";

    }
 
    const menuAberto = localStorage.getItem("menuAberto");

    if (menuAberto === "true") {

        body.classList.add("menu");

    }
 
    function UpdateMenuVisibility() {

        const aberto = body.classList.contains("menu");
 
        for (let i = 0; i < menutexto.length; i++) {

            if (aberto) {

                menutexto[i].style.setProperty("display", "block", "important");

                setTimeout(() => {

                    menutexto[i].style.opacity = "1";

                    menutexto[i].style.transform = "translateX(0)";

                }, 10);

            } else {

                menutexto[i].style.opacity = "0";

                menutexto[i].style.transform = "translateX(-20px)";

                setTimeout(() => {

                    menutexto[i].style.setProperty("display", "none", "important");

                }, 300);

            }

        }
 
        if (adminTitle) {

            if (aberto) {

                adminTitle.style.setProperty("display", "block", "important");

                setTimeout(() => {

                    adminTitle.style.opacity = "1";

                    adminTitle.style.transform = "translateX(0)";

                }, 10);

            } else {

                adminTitle.style.opacity = "0";

                adminTitle.style.transform = "translateX(-20px)";

                setTimeout(() => {

                    adminTitle.style.setProperty("display", "none", "important");

                }, 300);

            }

        }
 
        localStorage.setItem("menuAberto", aberto.toString());

    }
 
    UpdateMenuVisibility();
 
    const observer = new MutationObserver(UpdateMenuVisibility);

    observer.observe(body, { attributes: true, attributeFilter: ["class"] });
 
    const items = document.querySelectorAll("li");

    const barraLateral = {

        "analytics.php": "analytics-icon",

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

 