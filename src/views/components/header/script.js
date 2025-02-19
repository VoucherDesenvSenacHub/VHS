
const Menu = document.getElementById("Menu");
const Lupa = document.getElementById("Lupa");
const Body = document.body;
const Header = document.getElementById("Header");

Menu.addEventListener('click', function() {
Body.classList.toggle('Menu')
console.log(Body.classList)    
})

Lupa.addEventListener('click', function() {
Header.classList.toggle('Header')
console.log(Header.classList)    

    
})