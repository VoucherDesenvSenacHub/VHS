const menuBtn = document.getElementById('opcoes');
const menu = document.getElementById('menu');

menuBtn.addEventListener('click', () => {
    menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
});