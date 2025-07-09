const verifyEmail = () => {
    const description = document.querySelector(".description");
    let count = 5;

    const intervalId = setInterval(() => {
        description.innerText = `Seu e-mail foi verificado, você será redirecionado em ${count}...`
        if (--count === 0) {
            location.href = "/VHS/src/views/pages/home"
            clearInterval(intervalId);
        } 
    }, 1000);
}

document.querySelector(".verify-email-button").onclick = verifyEmail;