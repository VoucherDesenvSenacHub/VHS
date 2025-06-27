const menuBtns = document.querySelectorAll(".menu-btn");
const menus = document.querySelectorAll(".menu");

menuBtns.forEach((btn, index) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();


        menus.forEach((m, i) => {
            if (i !== index) m.style.display = "none";
        });


        menus[index].style.display = menus[index].style.display === "flex" ? "none" : "flex";
    });
});


document.addEventListener("click", (e) => {
    menus.forEach(menu => {
 
        if (!menu.contains(e.target)) {
            menu.style.display = "none";
        }
    });
});


menus.forEach(menu => {
    menu.addEventListener("click", (e) => {
        e.stopPropagation();
    });
});
