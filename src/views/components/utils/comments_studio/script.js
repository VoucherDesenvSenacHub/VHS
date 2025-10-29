    const formData = new FormData()

    async function likeComment(event, $comment_id, $like){
      event.preventDefault();
      formData.append('comment_id', $comment_id);
      formData.append('like', $like)
      
      const res = await fetch('/VHS/api/v1/studio/comments/creator-like', {
        method: 'POST',
        body: formData,
        withCredentials: 'include'
      });

      if (!res.ok){
        Swal.fire({
                toast: true,
                icon: 'error', 
                title: 'Erro',
                text: 'Erro Interno do Servidor',
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
        return;
      }

      if(event.target.getAttribute("like") === "1"){
        event.target.setAttribute("like", "0");
        event.target.src = '/VHS/public/icons/comments/favorite-comment.svg';

        Swal.fire({
                toast: true,
                icon: 'success', 
                title: 'Foi Retirado o Amei do Comentário',
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

        return;
      }

      Swal.fire({
                toast: true,
                icon: 'success', 
                title: 'Foi Adicionado um Amei ao Comentário',
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

      event.target.setAttribute("like", "1");
      event.target.src = '/VHS/public/icons/comments/favorite-comment-filled.svg';
    }

    async function blockUser(event, userId, userName) {
        event.preventDefault();

            Swal.fire({
                title: `Blockear Usuário ${userName}?`,
                text: "Tem certeza que deseja confirmar esta ação?",
                icon: "warning",
                preConfirm: async () => {
                    formData.append("userId", userId);

                    try {
                        const res = await fetch(`/VHS/api/v1/studio/userBlock`, {
                            method: "POST",
                            body: formData,
                            withCredentials: 'include'
                        });

                        if (!res.ok) {
                            Swal.showValidationMessage("Ocorreu um erro ao blockear o usuário.");
                            return;
                        }

                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: "Usuário Blockeado com sucesso.",
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } catch (error) {
                        console.error(error);
                        Swal.showValidationMessage("Erro ao enviar a requisição.");
                    }
                },
                showDenyButton: true,
                confirmButtonText: "Confirmar",
                denyButtonText: "Cancelar",
                customClass: {
                    popup: 'swal-custom',
                    title: 'swal-title',
                    htmlContainer: 'swal-text',
                    icon: 'swal-icon',
                    denyButton: 'swal-deny'
                },
            });

            return;
        }
    
    async function deleteComment(event, commentId, userName) {
        event.preventDefault();

            Swal.fire({
                title: `Deletar o comentário do ${userName}?`,
                text: "Tem certeza que deseja confirmar esta ação?",
                icon: "warning",
                preConfirm: async () => {
                    formData.append("commentId", commentId);

                    try {
                        const res = await fetch(`/VHS/api/v1/studio/comment/delete`, {
                            method: "POST",
                            body: formData,
                            withCredentials: 'include'
                        });

                        if (!res.ok) {
                            Swal.showValidationMessage("Ocorreu um erro ao deletar o comentário.");
                            return;
                        }

                        Swal.fire({
                            icon: "success",
                            title: "Sucesso!",
                            text: "Comentário deletado com sucesso.",
                            timer: 1500,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);

                    } catch (error) {
                        console.error(error);
                        Swal.showValidationMessage("Erro ao enviar a requisição.");
                    }
                },
                showDenyButton: true,
                confirmButtonText: "Confirmar",
                denyButtonText: "Cancelar",
                customClass: {
                    popup: 'swal-custom',
                    title: 'swal-title',
                    htmlContainer: 'swal-text',
                    icon: 'swal-icon',
                    denyButton: 'swal-deny'
                },
            });

            return;
        }