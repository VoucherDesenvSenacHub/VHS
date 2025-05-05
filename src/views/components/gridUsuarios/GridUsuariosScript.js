const actionButtons = document.querySelectorAll('.action-button');
const gridUsuarios = document.getElementById('grid-usuarios');


actionButtons.forEach(button => {
    button.addEventListener('click', function() {

        gridUsuarios.classList.toggle('active-grid-usuarios');
    });
});