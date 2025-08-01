const fast = document.querySelector(".current-fast");
const like = fast.querySelector("#heart");
const likes = fast.querySelector(".likes")

fast.addEventListener("click", () => {
    const video = fast.querySelector("video");
    const play = fast.querySelector(".play")
    video.paused ? video.play() : video.pause();
    play.classList.toggle("paused");
})

like.addEventListener("click", (e) => {
    e.stopImmediatePropagation();
    const heart = like.querySelector("path");
    const isLiked = heart.style.fill === "red";
    heart.style.fill = isLiked ? "white" : "red";
    likes.innerText = isLiked ? Number(likes.innerText) - 1 : Number(likes.innerText) + 1;
})