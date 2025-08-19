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
    if (event.target.closest('.opcoes')) {
        const button = event.target.closest('.opcoes');
        const menu = button.querySelector('.menu');
        if (menu) {
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
        }
    }
});

