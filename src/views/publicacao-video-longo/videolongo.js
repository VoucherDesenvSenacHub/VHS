document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('dropzone-file').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const videoPreview = document.getElementById('videoPreview');
            const uploadArea = document.getElementById('uploadArea');

            videoPreview.src = URL.createObjectURL(file);
            videoPreview.classList.remove('hidden');
            uploadArea.classList.add('hidden');

            videoPreview.load();
        }
    });



    var cancelar = document.getElementById('cancel-button');


    cancelar.addEventListener('click', function () {
        location.reload();
    })
});


