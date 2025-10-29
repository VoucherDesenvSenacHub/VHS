const titles = document.querySelectorAll(".title");
const texts = document.querySelectorAll(".menu-text");
const toggleButton = document.querySelector("#barrinha");
const sidebar = document.querySelector("aside");
const icons = document.querySelectorAll(".icon");
const separator = document.querySelector(".separator");

// var state = 1;


let isExpanded = true;
sidebar.style.transition = "width 0.3s ease";
sidebar.style.overflow = "hidden";

texts.forEach(text => {
    text.style.display = "inline-block";
    text.style.transition = "opacity 0.3s ease, transform 0.3s ease";
    text.style.whiteSpace = "nowrap";
});

const url = window.location.href;
url.includes("minimized") ? toggleSidebar(false) : null;

function checkRoute() {
    const urlSplit = url.split("/home");
    icons[0].classList.toggle("active", url.includes("/home") && urlSplit.at(-1) === "/" || urlSplit.at(-1) === "");
    icons[1].classList.toggle("active", url.includes("/home/fast"));
    icons[2].classList.toggle("active", url.includes("/home/events"));
    icons[3].classList.toggle("active", url.includes("/home/history"));  

    icons[4].classList.toggle("active", url.includes("category=tecnologia"));
    icons[5].classList.toggle("active", url.includes("category=saude"));
    icons[6].classList.toggle("active", url.includes("category=moda"));
    icons[7].classList.toggle("active", url.includes("category=estetica"));
} checkRoute();

function toggleSidebar(state) {
    isExpanded = state !== undefined ? state : !isExpanded;

    sidebar.style.width = isExpanded ? "12rem" : "5.5rem";
    sidebar.classList.toggle("hidden", isExpanded);

    separator.style.width = isExpanded ? "auto" : "2rem";

    titles.forEach(title => {
        title.style.display = isExpanded ? "block" : "none";
    });

    texts.forEach(text => {
        if (isExpanded) {
            text.style.opacity = "1";
            text.style.transform = "translateX(0)";
            return;
        }

        text.style.opacity = "0";
        text.style.transform = "translateX(-10px)"; 
    });
}

toggleButton.addEventListener("click", () => {
    toggleSidebar();
});
