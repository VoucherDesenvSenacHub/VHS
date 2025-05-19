document.addEventListener("DOMContentLoaded", function () {
    const texts = document.querySelectorAll(".menu-text");
    const divider = document.querySelector(".divider");
    const divides = document.querySelector(".divides");
    const toggleButton = document.getElementById("barrinha");
    const categoriaTitle = document.getElementById("categoria-title");
    const sidebar = document.getElementById("sidebar");
    let isExpanded = true;
   
    toggleButton.addEventListener("click", function () {
        isExpanded = !isExpanded;
        
        sidebar.style.width = isExpanded ? "9.25rem" : "3.5rem";
        sidebar.style.marginLeft = isExpanded ? "1.87rem" : "0.5rem";
        
        texts.forEach(text => {
            text.style.display = isExpanded ? "block" : "none";
            text.style.opacity = isExpanded ? "1" : "0";
            text.style.transition = "opacity 500ms ease-in-out";
        });
        
        divider.style.width = isExpanded ? "8.06rem" : "2.5rem";
        divider.style.transition = "width 500ms ease-in-out";
        
        divides.style.width = isExpanded ? "8.06rem" : "2.5rem";
        divides.style.transition = "width 500ms ease-in-out";

        categoriaTitle.style.display = isExpanded ? "block" : "none";

        const seta = document.querySelector("#seta");
        const path = seta.querySelector("path");
        
        if (isExpanded) {
            path.setAttribute("d", "M24.8995 16.2329C25.6972 16.6324 25.6972 17.7708 24.8995 18.1703L23.1524 19.0451C22.432 19.4059 21.584 18.8821 21.584 18.0765L21.584 16.3267C21.584 15.5211 22.432 14.9974 23.1524 15.3581L24.8995 16.2329Z");
        } else {
            path.setAttribute("d", "M3.1005 16.2329C2.3028 16.6324 2.3028 17.7708 3.1005 18.1703L4.8476 19.0451C5.568 19.4059 6.416 18.8821 6.416 18.0765L6.416 16.3267C6.416 15.5211 5.568 14.9974 4.8476 15.3581L3.1005 16.2329Z");
        }
    });

    const items = document.querySelectorAll("li");
   
    const barraLateral = {
        "Inicio.php": "home-icon",
        "Fast.php": "fast-icon",
        "Eventos.php": "eventos-icon",
        [encodeURIComponent("Histórico.php")]: "historico-icon",
        "Tecnologia.php": "tecnologia-icon",
        [encodeURIComponent("Saúde.php")]: "saude-icon",
        "Moda.php": "moda-icon",
        [encodeURIComponent("Estética.php")]: "estetica-icon"
    };
   
    for (const barra in barraLateral) {
        if (location.pathname.includes(barra)) {
            const iconDiv = document.querySelector(`.${barraLateral[barra]}`);
            if (iconDiv) {
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
               
                if (iconDiv) iconDiv.classList.remove("bg-[#660BAD]", "bg-opacity-100");
                if (icon) icon.style.filter = "";
                if (text) text.classList.remove("text-white");
            });

            const iconDiv = this.querySelector(".icon");
            const icon = this.querySelector(".icon img");
            const text = this.querySelector("h2");
           
            if (iconDiv) iconDiv.classList.add("bg-[#660BAD]", "bg-opacity-100");
            if (icon) icon.style.filter = "brightness(0) invert(1)";
            if (text) text.classList.add("text-white");
        });
    });
});