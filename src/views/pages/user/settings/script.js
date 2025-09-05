const categoriesInput = document.querySelector("#categoriesInput");
const categoriesElements = document.querySelectorAll(".category-btn");

categoriesElements.forEach((category) => {
    console.log(category.textContent.trim(), userCategories);

    if(userCategories.includes(category.textContent.trim())) {
        category.classList.add("bg-purple-600");
        category.innerText = "× " + category.textContent.trim();
        categoriesInput.value += categoriesInput.value.includes(category.textContent.trim()) ? "" : category.textContent.trim().replace("× ", "") + ",";
    }
    
    category.addEventListener("click", () => {
        category.classList.toggle("bg-purple-600");

        if(category.classList.contains("bg-purple-600")) {
            categoriesInput.value += categoriesInput.value.includes(category.textContent.trim()) ? "" : category.textContent.trim() + ",";
            category.innerText = "× " + category.textContent.trim();
            return;
        } 

        category.innerText = category.textContent.trim().replace("× ", "");
        categoriesInput.value = categoriesInput.value.replace(category.textContent.trim() + ",", "");
    });
})

