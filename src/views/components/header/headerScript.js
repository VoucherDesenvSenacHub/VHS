const body = document.body;
const buttonUserMenu = document.getElementById("open-user-menu");
const userMenu = document.getElementById("user-menu");
const search = document.getElementById("search");
const header = document.getElementById("header");
const searchButton = document.getElementById('search');
const searchBar = document.getElementById('search-bar');

search.addEventListener('click', () => {
    header.classList.toggle('header');
});

buttonUserMenu.addEventListener("click", (e) => {
    e.stopPropagation();
    userMenu.classList.remove("hidden");
    void userMenu.offsetWidth;

    userMenu.classList.remove("translate-y-full", "opacity-0", "scale-95");
    userMenu.classList.add("translate-y-0", "opacity-100", "scale-100");
});

document.addEventListener("click", (e) => {
    if (!userMenu.contains(e.target)) {
        userMenu.classList.remove("opacity-100", "translate-y-0", "scale-100");
        userMenu.classList.add("opacity-0", "translate-y-full", "scale-95");

        setTimeout(() => {
            userMenu.classList.add("hidden");
        }, 300);
    }
});

document.getElementById('button-myaccount').addEventListener('click', () => {
    window.location.href = '#';
});

document.getElementById('button-vhs-studio').addEventListener('click', async () => {
    const { value: formValues } = await Swal.fire({
        title: "Criar canal",
        html: `
        <input id="swal-nome" class="swal2-input" placeholder="@Rafael_">
        <input id="swal-identificador" class="swal2-input" placeholder="rafaelbonitao@senac.ms.com">
      `,
        customClass: {
            popup: "bg-gradient-to-b from-[#20002c] to-[#000000] text-white rounded-2xl shadow-lg",
            confirmButton: "bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded-lg",
            cancelButton: "bg-gray-700 hover:bg-gray-800 text-white font-semibold px-4 py-2 rounded-lg"
        },
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: "Criar",
        cancelButtonText: "Cancelar",
        preConfirm: () => {
            const nome = document.getElementById("swal-nome").value;
            const identificador = document.getElementById("swal-identificador").value;

            if (!nome || !identificador) {
                Swal.showValidationMessage("Preencha todos os campos!");
                return false;
            }

            return { nome, identificador };
        }
    });

    if (formValues) {
        // Faz a requisição POST para o PHP
        // const response = await fetch("/VHS/src/api/criarCanal.php", {
        //     method: "POST",
        //     headers: { "Content-Type": "application/json" },
        //     body: JSON.stringify(formValues)
        // });

        // const result = await response.json();

        // if (result.success) {
        //     Swal.fire({
        //         icon: "success",
        //         title: "Canal criado 🎉",
        //         text: `Nome: ${formValues.nome}\nIdentificador: ${formValues.identificador}`
        //     });
        // } else {
        //     Swal.fire({
        //         icon: "error",
        //         title: "Erro",
        //         text: result.message || "Não foi possível criar o canal."
        //     });
        // }
    }
});


document.getElementById('button-dashboard').addEventListener('click', () => {

});

document.getElementById('button-logout').addEventListener('click', () => {
    window.location.href = '#';
});

searchButton.addEventListener('click', () => {
    if (searchBar.classList.contains('hidden')) {
        searchBar.classList.remove('hidden');
        setTimeout(() => {
            searchBar.classList.remove('translate-x-full', 'opacity-0');
            searchBar.classList.add('translate-x-0', 'opacity-100');
            searchBar.querySelector('input').focus();
        }, 10);
    } else {
        searchBar.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            searchBar.classList.add('hidden');
        }, 300);
    }
});

document.addEventListener('click', (event) => {
    if (!searchButton.contains(event.target) && !searchBar.contains(event.target)) {
        searchBar.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            searchBar.classList.add('hidden');
        }, 300);
    }
});


