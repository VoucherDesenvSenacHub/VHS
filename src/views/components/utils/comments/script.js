    function hiddenCommentOptions(menuId = "") {
        const menus = document.querySelectorAll("div[role='menu']");
        menus.forEach(menu => {
            if(menu.id === menuId) return;
            menu.classList.add('hidden');
        });
    }

    function toggleCommentOptions(menuId) {
        menuId = "comment-options-" + menuId;
        hiddenCommentOptions(menuId);
        
        const menu = document.getElementById(menuId);
        menu.classList.toggle('hidden');
    }


    function handleEditComment(event, commentId) {
        event.preventDefault();

        const content = document.getElementById("comment-content-" + commentId);
        const formData = new FormData();

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
            return false;
        }

        formData.append("content", newContent.trim());

        const res = await fetch(`/VHS/api/v1/comment/edit?commentId=${commentId}`, {
            method: "POST",
            body: formData,
            credentials: "include"
        });

        const data = await res.json();

        if (!res.ok) {
            Swal.showValidationMessage(data.error || "Ocorreu um erro ao editar o comentário.");
            return false;
        }

        content.innerText = newContent.trim();
    }
    ,
            showCancelButton: true,
            confirmButtonText: "Editar",
            customClass: {
                popup: 'swal-custom',
                title: 'swal-title',
                htmlContainer: 'swal-text',
                icon: 'swal-icon'
            }
        });
    }