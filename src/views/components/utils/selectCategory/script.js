document.addEventListener("DOMContentLoaded", () => {
    
    const categoryPanel = document.getElementById("categoryPanel");
    const categoryList = document.getElementById("categoryList");
    const inputCategory = document.getElementById("category");
    const hiddenInput = document.getElementById("category_id_hidden");

    const categories = JSON.parse(categoryList.dataset.categories);
    const selectedId = categoryList.dataset.selectedId;

    categories.forEach((cat) => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.textContent = `# ${cat.name}`;
        btn.dataset.id = cat.id;
        btn.className = "hover:bg-white/10 rounded-md p-2 w-full text-start";

        if (cat.id === selectedId) {
            btn.classList.add("bg-white/20");
        }

        categoryList.appendChild(btn);
    });

    if (selectedId) {
        const selectedCat = categories.find(c => c.id === selectedId);
        if (selectedCat) {
            inputCategory.value = `# ${selectedCat.name}`;
        }
    }

    inputCategory.addEventListener("click", (e) => {
        e.stopPropagation();
        categoryPanel.classList.toggle("hidden");
    });

    document.addEventListener("click", (e) => {
        if (!categoryPanel.contains(e.target) && e.target !== inputCategory) {
            categoryPanel.classList.add("hidden");
        }
    });
    
    categoryList.addEventListener("click", (e) => {
        const categoryBtn = e.target.closest("button");
        if (!categoryBtn) return;

        const name = categoryBtn.textContent;
        const id = categoryBtn.dataset.id;

        inputCategory.value = name;
        hiddenInput.value = id;

        categoryPanel.classList.add("hidden");
    });

});