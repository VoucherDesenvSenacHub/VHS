const menuBtns = document.querySelectorAll(".menu-btn");
const menus = document.querySelectorAll(".menu");

menuBtns.forEach((btn, index) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();


        menus.forEach((m, i) => {
            if (i !== index) m.style.display = "none";
        });


        menus[index].style.display = menus[index].style.display === "flex" ? "none" : "flex";
    });
});


document.addEventListener("click", (e) => {
    menus.forEach(menu => {

        if (!menu.contains(e.target)) {
            menu.style.display = "none";
        }
    });
});


menus.forEach(menu => {
    menu.addEventListener("click", (e) => {
        e.stopPropagation();
    });
});

function confirmDeleteFast(button) {
    const form = button.closest('form');

    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        background: '#1f2937', // dark mode bg
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
