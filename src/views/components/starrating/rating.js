var currentRating = 0;

async function rating() {
    currentRating = 0;

    const starsElements = document.body.querySelectorAll('.star');
    starsElements.forEach((element) => {
        if(element.attributes.getNamedItem("aria-checked").value === "true") currentRating++;
    })

    const formData = new FormData();
    formData.append("stars", stars);

    await fetch("/api/v1/rating", {
        method: "POST",
        body: formData
    });
    
    Swal.fire({
        toast: true,
        icon: "success", 
        title: 'Vídeo avaliado com successo!',
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        customClass: {
            popup: 'swal-custom',
            title: 'swal-title',
            htmlContainer: 'swal-text',
            icon: 'swal-icon'
        }
    });
}