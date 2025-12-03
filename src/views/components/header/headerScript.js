const body = document.body;
const buttonUserMenu = document.getElementById("open-user-menu");
const userMenu = document.getElementById("user-menu");
const search = document.getElementById("search");
const header = document.getElementById("header");
const searchButton = document.getElementById('search');
const searchBar = document.getElementById('search-bar');

searchButton.addEventListener('click', () => {
    header.classList.toggle('search');

    if (header.classList.contains('search')) {
        setTimeout(() => {
            const input = searchBar.querySelector('input');
            if (input) input.focus();
        }, 100);
    }
});

buttonUserMenu.addEventListener("click", (e) => {
    e.stopPropagation();
    userMenu.classList.remove("hidden");
    void userMenu.offsetWidth;

    userMenu.classList.remove("translate-y-full", "opacity-0", "scale-95");
    userMenu.classList.add("translate-y-0", "opacity-100", "scale-100");
});

document.addEventListener("click", (e) => {
    if (!userMenu.contains(e.target)) {
        userMenu.classList.remove("opacity-100", "translate-y-0", "scale-100");
        userMenu.classList.add("opacity-0", "translate-y-full", "scale-95");

        setTimeout(() => {
            userMenu.classList.add("hidden");
        }, 300);
    }

    if (!searchButton.contains(e.target) && !searchBar.contains(e.target)) {
        header.classList.remove('search');
    }
});



