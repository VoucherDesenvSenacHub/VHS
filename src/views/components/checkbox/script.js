
const checkbox = document.getElementById("checkbox");
const customCheckbox = document.getElementById("customCheckbox");
const checkIcon = document.getElementById("checkIcon");

customCheckbox.addEventListener("click", () => {
    checkbox.checked = !checkbox.checked;
    
    customCheckbox.classList.toggle("bg-purple-700");
    customCheckbox.classList.toggle("border-gray300");
    checkIcon.classList.toggle("hidden");
});
