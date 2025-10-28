var currentRating = 0;

async function rating() {
    currentRating = 0;

    const starsElements = document.body.querySelectorAll('.star');
    starsElements.forEach((element) => {
        if(element.attributes.getNamedItem("aria-checked").value === "true") currentRating++;
    })

    const formData = new FormData();
    formData.append("stars", currentRating);
    formData.append("videoId", location.href.split("id=")[1].replace("#comments", ""));

    const res = await fetch("/VHS/api/v1/json/video/rating", {
        method: "POST",
        body: formData,
        withCredentials: 'include'
    });

    if(!res.ok) {
        return Swal.fire({
            toast: true,
            icon: "error",
            title: "Ocorreu um erro ao avaliar o avaliar o vídeo!",
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