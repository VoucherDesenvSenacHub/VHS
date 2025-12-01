document.addEventListener("DOMContentLoaded", () => {

    const fileInput = document.getElementById('dropzone-file');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');
    const previewBtn = document.getElementById('previewBtn');

    const previewModal = document.getElementById('previewModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');

    let previewSrc = null;

    if (fileInput) {
        fileInput.addEventListener('change', (event) => {

            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = (e) => {
                previewSrc = e.target.result;
                fileName.textContent = file.name;
                fileInfo.classList.remove("hidden");
            };

            reader.readAsDataURL(file);
        });
    }

    // Abrir modal
    previewBtn.addEventListener('click', () => {
        if (!previewSrc) return;
        modalImage.src = previewSrc;

        previewModal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    });

    function close() {
        previewModal.classList.add("hidden");
        document.body.style.overflow = "";
    }

    closeModal.addEventListener("click", close);
    previewModal.addEventListener("click", (e) => {
        if (e.target === previewModal) close();
    });

});