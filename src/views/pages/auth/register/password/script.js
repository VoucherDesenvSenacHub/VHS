function onSubmit(token) {
    
    const form = document.querySelector("form");
    const inputs = form.querySelectorAll("input");
    inputs[2].value = token;
    
    form.submit();
}