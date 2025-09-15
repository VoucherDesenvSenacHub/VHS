const texts = document.querySelectorAll(".menu-text");
const toggleButton = document.querySelector("#barrinha");
const sidebar = document.querySelector("aside");
const icons = document.querySelectorAll(".icon");

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
    const path = window.location.pathname;

    if (path.startsWith("/VHS/admin/analytics")) {
        icons[0].classList.add("active");
    } else {
        icons[0].classList.remove("active");
    }

    if (path.startsWith("/VHS/admin/users")) {
        icons[1].classList.add("active");
    } else {
        icons[1].classList.remove("active");
    }

    if (path.startsWith("/VHS/admin/complaints")) {
        icons[2].classList.add("active");
    } else {
        icons[2].classList.remove("active");
    }
}

checkRoute();


function toggleSidebar(state) {
    isExpanded = state !== undefined ? state : !isExpanded;

    sidebar.style.width = isExpanded ? "10.3rem" : "7.67rem";

    texts.forEach(text => {
        if (isExpanded) {
            text.style.opacity = "1";
            text.style.transform = "translateX(0)";
            return;
        }
        text.style.opacity = "0";
        text.style.transform = "translateX(-10px)";
       
    });

    separators.forEach(separator => {
        separator.style.width = isExpanded ? "auto" : "2rem";
    });
}

toggleButton.addEventListener("click", () => {
    toggleSidebar();
});
