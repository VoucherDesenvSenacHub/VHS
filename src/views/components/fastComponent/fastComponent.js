
        const like = document.getElementById("coracao")
        const div = document.querySelector(".current_fast")
        const video =document.querySelector('.current_fast > video')
        const play =document.querySelector('.current_fast > .play')
 
        like.onclick = (e) => {
            console.log('teste')
            e.stopPropagation(e);
            const pathSvg = like.querySelector("path")
 
            if(pathSvg.getAttribute('fill') === "red") {
                return pathSvg.setAttribute('fill', "white")
            }
 
            pathSvg.setAttribute('fill', 'red')
 
           
        }
 
        const pauseFunction = (e) => {
           
            if(e.key && e.key !== " ") return;
 
            if(video.paused) {
                video.play()
                play.classList.add('paused')
                return
            }
 
            video.pause()
            play.classList.remove('paused')
        }
 
        div.onclick = pauseFunction
        document.body.addEventListener('keypress', pauseFunction)
