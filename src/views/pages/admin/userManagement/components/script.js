const modal = document.getElementById("deleteModal");
const closeBtn = document.getElementById("closeDeleteModal");
const userIdInput = document.getElementById("deleteUserId");
const userNameSpan = document.getElementById("deleteUserName");

document.querySelectorAll(".open-delete").forEach(btn => {
    btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-id");
        const name = btn.getAttribute("data-name");

        userIdInput.value = id;
        userNameSpan.textContent = name;
        modal.classList.remove("hidden");
    });
});

closeBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
});


const editModal = document.getElementById("editModal");
const closeEditBtn = document.getElementById("closeEditModal");

const editUserId = document.getElementById("editUserId");
const editName = document.getElementById("editName");
const editRole = document.getElementById("editRole");
const editStatus = document.getElementById("editStatus");

document.querySelectorAll(".open-edit").forEach(btn => {
    btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-id");
        const name = btn.getAttribute("data-name");
        const role = btn.getAttribute("data-role");
        const status = btn.getAttribute("data-status");

        editUserId.value = id;
        editName.value = name;
        editRole.value = role;
        editStatus.value = status;

        editModal.classList.remove("hidden");
    });
});

closeEditBtn.addEventListener("click", () => {
    editModal.classList.add("hidden");
});