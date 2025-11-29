console.log("OnScroll Fast Component Loaded");


async function addViewFast(fastId) {
    const data = new FormData();
    data.append("fast_id", fastId);

    try {
        await fetch('/VHS/api/v1/json/fast/view', {
            method: 'POST',
            body: data,
            withCredentials: "include",
        });
    } catch (error) {
        console.error('Error adding view:', error);
    }
}
async function likeFast(event, fastId) {
    event.stopPropagation();

    const container = event.currentTarget;
    const heartPath = container.querySelector("#heart path");
    const likesText = container.querySelector(".likes");

    try {
        const data = new FormData();
        data.append("fast_id", fastId);

        const response = await fetch('/VHS/api/v1/json/fast/like', {
            method: 'POST',
            body: data,
            withCredentials: "include",
        });

        const responseData = await response.json();

        if (responseData.status === "success") {
            console.log(responseData?.liked, "liked?");
            likesText.textContent = responseData.likes;
            if (responseData.liked) {
                heartPath.setAttribute('fill', '#ef4444');
            } else {
                heartPath.setAttribute('fill', 'white');
            }
        } else {
            console.error('Failed to like fast:', responseData.message);
        }
    } catch (error) {
        console.error('Error liking fast:', error);
    }
}


// const fast = document.querySelector(".current-fast");
// const like = fast.querySelector("#heart");
// const likes = fast.querySelector(".likes")

// fast.addEventListener("click", () => {
//     const video = fast.querySelector("video");
//     const play = fast.querySelector(".play")
//     video.paused ? video.play() : video.pause();
//     play.classList.toggle("paused");
// })

// like.addEventListener("click", (e) => {
//     e.stopImmediatePropagation();
//     const heart = like.querySelector("path");
//     const isLiked = heart.style.fill === "red";
//     heart.style.fill = isLiked ? "white" : "red";
//     likes.innerText = isLiked ? Number(likes.innerText) - 1 : Number(likes.innerText) + 1;
// })