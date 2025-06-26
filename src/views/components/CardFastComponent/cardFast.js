const menuBtn = document.querySelectorAll(".menu-btn")
const menu = document.querySelectorAll('.menu');


menuBtn.forEach((btn,card) => {
    btn.addEventListener('click', () => {
        
        menu[card].style.display = menu[card].style.display === 'flex' ? 'none' : 'flex';

    })
});

