function resetTextareaHeight(form) {
    const textareas = form.querySelectorAll("textarea");
    textareas.forEach(el => el.style.height = "42px");
    textareas.value = ''
}  

    function autoResizeTextarea(el) {
    if (el.value.trim() === "") {
        el.style.height = "42px";
    } else {
        el.style.height = "auto";
        el.style.height = el.scrollHeight + "px";
    }
}
  document.addEventListener("click", (event) => {
  if (event.target.classList.contains("toggle-readmore")) {
      const button = event.target;

      const commentContainer = button.closest(".comment-container"); 
      const textEl = commentContainer.querySelector(".comment-text");

      if (textEl.classList.contains("max-h-16")) {
          textEl.classList.remove("max-h-16");
          button.textContent = "Ler menos";
      } else {
          textEl.classList.add("max-h-16");
          button.textContent = "Ler mais";
      }
  }
});

document.addEventListener('click', (event) => {
    const button = event.target.closest('.opcoes');

    if (button) {
        const menu = button.querySelector('.menu');

        if (menu) {
            
            document.querySelectorAll('.menu').forEach(m => {
                if (m !== menu) {
                    m.style.display = 'none';
                }
            });

            
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
        }
    } else {
        
        document.querySelectorAll('.menu').forEach(m => {
            m.style.display = 'none';
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    document.body.addEventListener("click", (event) => {
        // Captura qualquer clique dentro do botão .edit-comment
        const btn = event.target.closest(".edit-comment");
        if (!btn) return;

        // Teste: alerta e log
        window.alert("Funfo");
        console.log("Botão clicado, data-id:", btn.dataset.id);
    });
});


        // const commentId = editBtn.dataset.id;
        // const container = editBtn.closest(".comment-container");
        // const textEl = container.querySelector(".comment-text");
        // const oldText = textEl.innerText;

        // // Substitui pelo textarea
        // const textarea = document.createElement("textarea");
        // textarea.value = oldText;
        // textarea.className = "w-full p-2 bg-gray-800 text-white rounded-md resize-none";

        // const saveBtn = document.createElement("button");
        // saveBtn.innerText = "Salvar";
        // saveBtn.className = "bg-blue-600 text-white px-2 py-1 rounded ml-2";

        // const cancelBtn = document.createElement("button");
        // cancelBtn.innerText = "Cancelar";
        // cancelBtn.className = "bg-gray-600 text-white px-2 py-1 rounded ml-2";

        // // Troca o conteúdo
        // textEl.replaceWith(textarea);
        // editBtn.replaceWith(saveBtn);
        // saveBtn.insertAdjacentElement("afterend", cancelBtn);

        // // Cancelar
        // cancelBtn.addEventListener("click", () => {
        //     textarea.replaceWith(textEl);
        //     saveBtn.replaceWith(editBtn);
        //     cancelBtn.remove();
        // });

        // // Salvar
        // saveBtn.addEventListener("click", () => {
        //     fetch("/VHS/src/application/routes/route.php/api/v1/home/video/edit", {
        //         method: "POST",
        //         headers: { "Content-Type": "application/json" },
        //         body: JSON.stringify({
        //             comment_id: commentId,
        //             content: textarea.value,
        //         })
        //     })
        //     .then(res => res.json())
        //     .then(data => {
        //         if (data.status === "success") {
        //             textEl.innerText = textarea.value;
        //             textarea.replaceWith(textEl);
        //             saveBtn.replaceWith(editBtn);
        //             cancelBtn.remove();
        //         } else {
        //             alert("Erro ao editar comentário!");
        //         }
        //     });
        // });
//     }

// });
