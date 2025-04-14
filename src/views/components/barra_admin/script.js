document.addEventListener("DOMContentLoaded", function () {

    const texts = document.querySelectorAll(".menu-text");

    const divider = document.querySelector(".divider");

    const divides = document.querySelector(".divides");

    const categoriaTitle = document.getElementById("categoria-title");


    toggleButton.addEventListener("click", function () {

        texts.forEach(text => {

            text.classList.toggle("opacity-0");

        });
        if (divider.classList.contains("w-[8.06rem]")) {

            divider.classList.remove("w-[8.06rem]");

            divider.classList.add("w-[2rem]");

        } else {

            divider.classList.remove("w-[2rem]");

            divider.classList.add("w-[8.06rem]");

        }

        if (divides.classList.contains("w-[8.06rem]")) {

            divides.classList.remove("w-[8.06rem]");

                divides.classList.add("w-[2rem]");

            } else {

                divides.classList.remove("w-[2rem]");

                divides.classList.add("w-[8.06rem]");

            }
           
            categoriaTitle.style.display = categoriaTitle.style.display === "none" ? "block" : "none";

        });

    });




document.addEventListener("DOMContentLoaded", function () {

    const items = document.querySelectorAll("li");

    const barraLateral = {

        "analytics.php": "analytics-icon",

        "usuarios.php": "usuarios-icon",

    };

    for (const barra in barraLateral) {

        if (location.pathname.includes(barra)) {

            const iconDiv = document.querySelector(`.${barraLateral[barra]}`);

            if (iconDiv) {

                iconDiv.classList.remove("bg-white","bg-opacity-10");

                iconDiv.classList.add("bg-[#660BAD]", "bg-opacity-100");


                const img = iconDiv.querySelector("img");

                const text = iconDiv.parentElement.querySelector("h2");

                if (img) img.style.filter = "brightness(0) invert(1)";

                if (text) text.classList.add("text-white");

            }

        }

    }


    items.forEach(item => {

        item.addEventListener("click", function () {

            items.forEach(i => {

                const iconDiv = i.querySelector(".icon");

                const icon = i.querySelector(".icon img");

                const text = i.querySelector("h2");


                if (iconDiv) {

                    iconDiv.classList.remove("bg-[#660BAD]", "bg-opacity-100");

                    iconDiv.classList.add("bg-white","bg-opacity-10");

                }

                if (icon) icon.style.filter = "";

                if (text) text.classList.remove("text-white");

            });

            const iconDiv = this.querySelector(".icon");

            const icon = this.querySelector(".icon img");

            const text = this.querySelector("h2");

            if (iconDiv){

                 iconDiv.classList.remove("bg-white","bg-opacity-10");

                 iconDiv.classList.add("bg-[#660BAD]", "bg-opacity-100");

            }

            if (icon) icon.style.filter = "brightness(0) invert(1)";

            if (text) text.classList.add("text-white");
        });

    });

});

