console.log("OnScroll Fast Component Loaded");

let page = 1;
let isFetching = false;
let viewTimeout;
let hasUserInteracted = false;

function time(miliseconds) {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve();
        }, miliseconds)
    })
}

function playVideo(event) {
    const container = event.currentTarget;
    const video = container.querySelector("video");
    const play = container.querySelector(".play");

    if (video.paused) {
        video.play().catch(e => console.error("Error playing video:", e));
        hasUserInteracted = true;
        video.classList.add("currently-playing");
        play.classList.add("hidden");
    } else {
        video.pause();
        video.classList.remove("currently-playing");
        play.classList.remove("hidden");
    }
}

async function sectionFastScroll(event) {
    const container = event.target;
    const containerRect = container.getBoundingClientRect();
    const containerCenter = containerRect.top + containerRect.height / 2;

    // Find the closest snap-center element to the center of the container
    const fastComponents = Array.from(document.querySelectorAll(".snap-center"));

    let closest = null;
    let minDiff = Infinity;

    fastComponents.forEach(div => {
        const divRect = div.getBoundingClientRect();
        const divCenter = divRect.top + divRect.height / 2;
        const diff = Math.abs(containerCenter - divCenter);

        if (diff < minDiff) {
            minDiff = diff;
            closest = div;
        }
    });

    if (!closest) return;

    const video = closest.querySelector("video");
    if (!video) return;

    // Pause all other videos
    document.querySelectorAll("video").forEach(v => {
        if (v !== video) {
            v.pause();
            v.classList.remove("currently-playing");
            const playButton = v.parentElement.querySelector(".play");
            if (playButton) playButton.classList.remove("hidden");
        }
    });

    // Handle the closest video
    if (!video.classList.contains("currently-playing")) {
        // Only autoplay if user has interacted previously
        if (hasUserInteracted) {
            video.play().catch(e => console.log("Autoplay prevented:", e));
            video.classList.add("currently-playing");
            const playBtn = video.parentElement.querySelector(".play");
            if (playBtn) playBtn.classList.add("hidden");
        } else {
            // If no interaction yet, ensure it's paused and show play button
            video.pause();
            video.classList.remove("currently-playing");
            const playBtn = video.parentElement.querySelector(".play");
            if (playBtn) playBtn.classList.remove("hidden");
        }

        // Reset time only if it wasn't already playing (which is true here inside the if)
        // Actually, for scrolling, we might not want to reset time always if we just scrolled a tiny bit back and forth.
        // But for snap logic, usually we want to start fresh or continue. 
        // Let's keep it simple: if we switch videos, we reset.
        // Since we check !classList.contains("currently-playing"), this block runs when we switch TO this video.
        // So resetting time is appropriate.
        // video.currentTime = 0; // Optional: reset to start when scrolling into view

        const fastId = closest.getAttribute("data-id");
        if (fastId) {
            // Update URL without reloading
            const url = new URL(window.location);
            url.searchParams.set('id', fastId);
            window.history.replaceState(null, "", url);

            clearTimeout(viewTimeout);
            viewTimeout = setTimeout(() => {
                addViewFast(fastId);
            }, 2000);
        }
    }

    // Infinite scroll logic
    const index = fastComponents.indexOf(closest);
    const totalVideos = fastComponents.length;

    // Load more when close to the end (e.g., last video)
    if (index >= totalVideos - 1 && !isFetching) {
        page++;
        isFetching = true;
        try {
            const response = await fetch(`/VHS/api/v1/ajax/fasts?page=${page}`);
            if (response.ok) {
                const data = await response.text();
                if (data.trim().length > 0) {
                    container.insertAdjacentHTML('beforeend', data);
                }
            }
        } catch (error) {
            console.error("Error fetching more fasts:", error);
        } finally {
            await time(2000); // Debounce
            isFetching = false;
        }
    }
}
