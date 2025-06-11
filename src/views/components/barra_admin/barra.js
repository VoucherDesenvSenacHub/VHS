document.addEventListener("DOMContentLoaded", function () {

    const body = document.body;

    const adminTitle = document.querySelector(".admin-title");

    const menutext = document.getElementsByClassName("menu-text"); //
 

    if (adminTitle) {

        adminTitle.style.transition = "opacity 0.3s ease, transform 0.3s ease";

        adminTitle.style.opacity = "0";

        adminTitle.style.transform = "translateX(-20px)";

    }
 
    for (let i = 0; i < menutext.length; i++) {

        menutext[i].style.transition = "opacity 0.3s ease, transform 0.3s ease";

        menutext[i].style.opacity = "0";

        menutext[i].style.transform = "translateX(-20px)";

    }
 
    const menuopen = localStorage.getItem("menuopen");

    if (menuopen === "true") {

        body.classList.add("menu");

    }
 
    function UpdateMenuVisibility() {

        const open = body.classList.contains("menu");
 
        for (let i = 0; i < menutext.length; i++) {

            if (open) {

                menutext[i].style.setProperty("display", "block", "important");

                setTimeout(() => {

                    menutext[i].style.opacity = "1";

                    menutext[i].style.transform = "translateX(0)";

                }, 10);

            } else {

                menutext[i].style.opacity = "0";

                menutext[i].style.transform = "translateX(-20px)";

                setTimeout(() => {

                    menutext[i].style.setProperty("display", "none", "important");

                }, 300);

            }

        }
 
        if (adminTitle) {

            if (open) {

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
 
        localStorage.setItem("menuopen", open.toString());

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

 