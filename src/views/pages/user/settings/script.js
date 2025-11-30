const categoriesInput = document.querySelector("#categoriesInput");
const categoriesElements = document.querySelectorAll(".category-btn");

categoriesElements.forEach((category) => {
    // Check initial state
    if (userCategories.includes(category.textContent.trim())) {
        category.classList.add("active");
        // Add checkmark visually if needed, or just rely on color
        // category.innerHTML = `✓ ${category.textContent.trim()}`; 

        // Update hidden input
        updateInput(category.textContent.trim(), true);
    }

    category.addEventListener("click", () => {
        category.classList.toggle("active");
        const isActive = category.classList.contains("active");

        updateInput(category.textContent.trim(), isActive);
    });
});

function updateInput(categoryName, add) {
    let currentValues = categoriesInput.value ? categoriesInput.value.split(',').filter(Boolean) : [];

    if (add) {
        if (!currentValues.includes(categoryName)) {
            currentValues.push(categoryName);
        }
    } else {
        currentValues = currentValues.filter(c => c !== categoryName);
    }

    categoriesInput.value = currentValues.join(',') + (currentValues.length ? ',' : '');
}

