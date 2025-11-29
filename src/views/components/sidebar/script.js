const titles = document.querySelectorAll(".title");
const texts = document.querySelectorAll(".menu-text");
const toggleButton = document.querySelector("#barrinha");
const sidebar = document.querySelector("aside");
const icons = document.querySelectorAll(".icon");
const separator = document.querySelector(".separator");

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

function CategoriesON(event) {
    
    const button = event.currentTarget;
    const image = button.querySelector('img');
    const title = button.querySelector('h3');

   
    const wrapper = document.getElementById("categories-wrapper");
    const list = document.getElementById("categories-list");
  
    if (!wrapper || !list) {
        console.error("Erro: Wrapper ou lista de categorias não encontrados.");
        return;
    }

    const isOpen = wrapper.classList.contains('grid-rows-[1fr]');

    if (isOpen) {
    
        image.classList.remove('active');
        image.src = "/VHS/public/icons/GridOff.svg";

        title.classList.remove('text-white');
        title.classList.add('hover:text-secondary');
        

        wrapper.classList.remove('grid-rows-[1fr]');
        wrapper.classList.add('grid-rows-[0fr]');

    } else {

        image.classList.add('active');
        image.src = "/VHS/public/icons/GridOn.svg";

        title.classList.add('text-white');
        title.classList.remove('hover:text-secondary');
    

        wrapper.classList.remove('grid-rows-[0fr]');
        wrapper.classList.add('grid-rows-[1fr]');

        setTimeout(() => {
             if(wrapper.classList.contains('grid-rows-[1fr]')) {

                 list.classList.add('max-h-80', 'overflow-y-auto', 'pr-2');
             }
        }, 50);
    }
}