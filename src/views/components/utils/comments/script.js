document.addEventListener('click', (event) => {
    if (event.target.closest('.opcoes')) {
        const button = event.target.closest('.opcoes');
        const menu = button.querySelector('.menu');
        if (menu) {
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
        }
    }
});