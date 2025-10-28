function toggleCommentOptions(menuId) {
    console.log("Toggling menu:", menuId);
    const menu = document.getElementById("comment-options-" + menuId);

    if(!menu) {
        console.error("Menu not found:", menuId);
        return;
    }

    menu.classList.toggle('hidden');
}


function handleEditComment(event, commentId) {
    event.preventDefault();

    console.log("Handling edit for comment:", commentId);

    const content = document.getElementById("comment-content-" + commentId);
    const formElement = event.currentTarget;
    const buttonElement = formElement.querySelector('button');

    const formData = new FormData();

    console.log(formData);
    
    if(buttonElement.innerText === "Editar") {
        Swal.fire({
            title: "Edite seu comentário",
            text: "Faça as alterações desejadas no seu comentário abaixo:",
            input: "text",
            inputValue: content.textContent.trim(),
            inputAttributes: {
                autocapitalize: "off"
            },
            preConfirm: async (newContent) => {
                if (!newContent || newContent.trim() === "") {
                    Swal.showValidationMessage("O comentário não pode estar vazio.");
                }

                formData.append("content", newContent.trim());
                
                const res = await fetch(`/VHS/api/v1/comment/edit?commentId=${commentId}`, {
                    method: "POST",
                    body: formData,
                    withCredentials: 'include'
                });


                if(!res.ok) {
                    Swal.showValidationMessage("Ocorreu um erro ao editar o comentário.");
                    return;
                }
                
                content.innerText = newContent.trim();
                return newContent.trim();
            },
            showCancelButton: true,
            confirmButtonText: "Editar",
            customClass: {
                popup: 'swal-custom',
                title: 'swal-title',
                htmlContainer: 'swal-text',
                icon: 'swal-icon'
            }
        });
        return;
    }


    
    formElement.submit();
}