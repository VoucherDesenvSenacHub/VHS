
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


document.addEventListener("click", (event) => {
    const btn = event.target.closest(".edit-comment");
    if (!btn) return;

    const commentContainer = btn.closest(".comment-container");
    const commentTextEl = commentContainer.querySelector(".comment-text");
    let toggle = commentContainer.querySelector(".toggle-readmore");

    if (!commentTextEl) return;

    const oldText = commentTextEl.innerText;
    const commentId = btn.dataset.id;

    if (toggle) toggle.classList.add("hidden");

    const textarea = document.createElement("textarea");
    textarea.value = oldText;
    textarea.className =
        "bg-transparent w-full text-white p-1 outline outline-1 outline-[#666666] rounded-md resize-none overflow-hidden min-h-[45px]";

    const autoResize = (el) => {
        el.style.height = "auto";
        el.style.height = el.scrollHeight + "px";
    };
    textarea.addEventListener("input", () => autoResize(textarea));
    autoResize(textarea);

    const div = document.createElement("div");
    div.className = "mt-2 w-2/3 flex self-end gap-4";

    const saveBtn = document.createElement("button");
    saveBtn.innerText = "Salvar";
    saveBtn.className =
        "ml-2 gap-2 flex justify-center items-center h-[2.18rem] rounded-md cursor-pointer text-[#D9D9D9] bg-purple-700 transition-colors hover:bg-purple-800 !w-full";

    const cancelBtn = document.createElement("button");
    cancelBtn.innerText = "Cancelar";
    cancelBtn.className =
        "ml-2 gap-2 flex justify-center items-center h-[2.18rem] rounded-md cursor-pointer text-[#D9D9D9] outline outline-1 outline-purple-500 !w-full";

    commentTextEl.replaceWith(textarea);
    textarea.insertAdjacentElement("afterend", div);
    div.appendChild(cancelBtn);
    div.appendChild(saveBtn);

    cancelBtn.addEventListener("click", () => {
        textarea.replaceWith(commentTextEl);
        div.remove();
        if (toggle) toggle.classList.remove("hidden");
    });

    saveBtn.addEventListener("click", () => {
        const newText = textarea.value;

        console.log("Enviando para backend:", { commentId, newText });

        fetch("/VHS/src/application/routes/route.php/api/v1/home/video/edit", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `comment_id=${encodeURIComponent(commentId)}&content=${encodeURIComponent(newText)}`,
        })
            .then((res) => res.json())
            .then((data) => {
                console.log("Resposta do backend:", data);

                if (data.status === "success") {
                    const updatedTextEl = commentTextEl.cloneNode(true);
                    updatedTextEl.innerText = newText;

                    textarea.replaceWith(updatedTextEl);

                    if (newText.length > 150) {
                        if (!toggle) {
                            toggle = document.createElement("button");
                            toggle.className =
                                "text-blue-400 text-xs mt-1 toggle-readmore self-start";
                            toggle.innerText = "Ler mais";
                            updatedTextEl.insertAdjacentElement("afterend", toggle);
                        }
                    } else if (toggle) {
                        toggle.remove();
                    }
                    
                } else {
                    alert("Erro ao salvar comentário.");
                    textarea.replaceWith(commentTextEl);
                }

                div.remove();
            })
            .catch((err) => {
                console.error("Erro no fetch:", err);
                textarea.replaceWith(commentTextEl);
                div.remove();
            });
    });
});



