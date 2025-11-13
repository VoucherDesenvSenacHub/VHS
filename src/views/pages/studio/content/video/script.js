document.addEventListener('DOMContentLoaded', () => {
    const inputFile = document.getElementById('dropzone-file');
    const previewImg = document.getElementById('thumbnailPreview');
    const uploadText = document.getElementById('uploadText');

    const showUploadText = () => {
        uploadText.classList.remove('hidden'); 
        previewImg.classList.add('hidden'); 
    };

    const showPreview = () => {
        uploadText.classList.add('hidden'); 
        previewImg.classList.remove('hidden'); 
    };

    // testa a src inicial (pode ser vazia)
    const initialSrc = previewImg?.getAttribute('src') || '';
    if (initialSrc && initialSrc.trim() !== '') {
        const tester = new Image();
        tester.onload = () => showPreview();
        tester.onerror = () => showUploadText();
        tester.src = initialSrc;
    } else {
        showUploadText();
    }

    // Quando escolher novo arquivo
    if (inputFile) {
        inputFile.addEventListener('change', (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) {
                const src = previewImg.getAttribute('src') || '';
                if (!src) showUploadText();
                return;
            }

            const reader = new FileReader();
            reader.onload = (ev) => {
                previewImg.src = ev.target.result;
                showPreview();
            };
            reader.readAsDataURL(file);
        });
    }

    // Se por algum motivo o <img> falhar depois
    if (previewImg) {
        previewImg.addEventListener('error', () => showUploadText());
    }
});