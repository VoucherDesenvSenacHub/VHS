const menu = document.getElementById("menu");
const search = document.getElementById("search");
const body = document.body;
const header = document.getElementById("header");

menu.addEventListener('click', function() {
body.classList.toggle('menu')
})

search.addEventListener('click', function() {
header.classList.toggle('header')   
})