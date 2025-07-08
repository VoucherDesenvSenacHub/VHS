const categories = document.querySelectorAll(".category")

console.log(categories);

categories.forEach((categoryInput) => {
    categoryInput.onclick = (e) => {
        e.target.classList.toggle("bg-purple-700");
        e.target.classList.toggle("selected");
    };
})