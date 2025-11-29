console.log("OnScroll Fast Component Loaded");

let page = 1;
let isFetching = false;
let viewTimeout;
const video = document.querySelector("video");
const videoHeight = video.clientHeight;

function time(miliseconds) {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve();
        }, miliseconds)
    })
}

function playVideo(event) {
    const fast = event.currentTarget;
    const video = fast.querySelector("video");
    const play = fast.querySelector(".play")
    video.paused ? video.play() : video.pause();
    video.classList.toggle("currently-playing");
    play.classList.toggle("hidden");
}

async function sectionFastScroll(event) {
    const videos = document.querySelectorAll("video");
    const totalVideos = videos.length;
    const index = Math.floor(event.target.scrollTop / (videoHeight + 28));

    if (index % 1 !== 0) return;

    document.querySelectorAll(".currently-playing").forEach(v => {
        v.pause();
        v.classList.remove("currently-playing");
        const playButton = v.parentElement.querySelector(".play");
        playButton.classList.remove("hidden");
    });


    if (!videos[index]) return;

    videos[index].classList.add("currently-playing");
    videos[index].play();
    videos[index].currentTime = 0;
    videos[index].parentElement.querySelector(".play").classList.add("hidden");

    const fastId = videos[index].parentElement.getAttribute("data-id");
    if (fastId) {
        history.replaceState(null, "", "?id=" + fastId);
        clearTimeout(viewTimeout);
        viewTimeout = setTimeout(() => {
            addViewFast(fastId);
        }, 2000);
    }

    if (index === totalVideos - 1 && !isFetching) {
        page++;
        isFetching = true;
        const response = await fetch(`/VHS/api/v1/ajax/fasts?page=${page}`);
        const data = await response.text();
        event.target.innerHTML += data;

        await time(2000);
        isFetching = false;
    }
}
