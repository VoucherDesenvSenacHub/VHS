document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll("li");

    const barraLateral = {
        "Inicio.php": "home-icon",
        "Fast.php": "fast-icon",
        "Eventos.php": "eventos-icon",
        "Histótico.php": "historico-icon",
        "Tecnologia.php": "tecnologia-icon",
        "Saúde.php": "saude-icon",
        "Moda.php": "moda-icon",
        "Estética.php": "estetica-icon"
    };

    for (const barra in barraLateral) {
        if (location.pathname.includes(barra)) {
            document.querySelector(`.${barraLateral[barra]}`).classList.add("bg-[#660BAD]", "bg-opacity-100");
        }
    }

    items.forEach(item => {
        item.addEventListener("click", function () {
            items.forEach(el => {
                el.querySelector(".icon").classList.remove("bg-[#660BAD]", "bg-opacity-100");
            });
            item.querySelector(".icon").classList.add("bg-[#660BAD]", "bg-opacity-100");
        });
    });
});
    