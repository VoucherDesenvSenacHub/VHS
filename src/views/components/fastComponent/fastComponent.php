<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/global.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>componenteFast</title>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="w-sm h-[43rem] relative flex items-center justify-center current_fast">
        <video src="./videotst.mp4" class="object-cover h-full absolute -z-10 rounded-xl" autoplay muted loop></video>
        <img src="/VHS/public/icons/fasticon/setinha.svg" alt="" class="size-6 absolute left-[0.5rem] top-[1rem]"/>
        <img src="/VHS/public/icons/fasticon/Play.svg" alt="" class="size-16 play paused"/>
        <div class="flex items-center flex-col absolute right-4 bottom-32">
            <svg width="40" height="35" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg" id="coracao" class="z-50">
                <path d="M0 11.8981C0 21.7849 8.03885 27.0534 13.9235 31.7692C16 33.4332 18 35 20 35C22 35 24 33.4332 26.0765 31.7692C31.9611 27.0534 40 21.7849 40 11.8981C40 2.01125 28.9997 -5.0003 20 4.50478C11.0003 -5.0003 0 2.01125 0 11.8981Z" fill="white"/>
            </svg>
            <h1 class="text-white text-sm">20k</h1>
        </div>
       
        <img src="/VHS/public/icons/fasticon/Share.svg" alt="" class="absolute right-4 bottom-16">
        <div class="flex flex-col absolute left-2 bottom-15 text-white ">
            <div class="flex gap-2">
                <img class="size-8 rounded-sm" src="https://lh3.googleusercontent.com/hOiSVlpbDc8uKDXZMb3AOQX9GBn1NQbd0H0j4yo4CmpqzDxQbL8x42scp56ze5TTn-UCb6LdtOEYnhxU6Ilg0w8k-VNHJ3mObrv2_bf6N7aMvWtRpQ=h600" alt="">
                <h1 class="text-xl">titulo</h1>
            </div>
            <h2>asdasdasdAsddasdasdadad descrição</h2>
        </div>
    </div>
    <script>
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
    </script>
    <style>
        @keyframes smooth {
            from {
                transform: scale(0.9);
                opacity: 0;
            } to {
                opacity: 1;
                transform: scale(1);
            }
        }
 
        @keyframes hidden_smooth {
            to {
                opacity: 0;
            }
        }
 
 
        .play {
            animation: smooth 0.15s ease-in;
        }
        
 
        .play.paused {
            animation: hidden_smooth 0.15s ease-in;
            animation-fill-mode: forwards;
        }
    </style>
</body>
</html>
 