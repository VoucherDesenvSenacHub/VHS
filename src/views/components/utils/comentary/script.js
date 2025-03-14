const menuBtn = document.getElementById('3botao');
const menu = document.getElementById('menu');

menuBtn.addEventListener('click', () => {
    menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
});