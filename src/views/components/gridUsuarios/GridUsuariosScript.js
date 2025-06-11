const actionButtons = document.querySelectorAll('.action-button');
const gridUsuarios = document.getElementById('grid-usuarios');


actionButtons.forEach(button => {
    button.addEventListener('click', function() {

        gridUsuarios.classList.toggle('active-grid-usuarios');
    });
});

const deleteUser = document.getElementById('delete_user')
const cardDelete = document.getElementById('card_delete')
const userMenu = document.getElementById('user_menu')
const cardMenu = document.getElementById('card_user');

deleteUser.addEventListener('click', () => {
    cardDelete.style.display = cardDelete.style.display === 'flex' ? 'none' : 'flex';
});

userMenu.addEventListener('click', () => {
    cardMenu.style.display = cardMenu.style.display === 'flex' ? 'none' : 'flex';
});