<?php

namespace src\views\components\utils;

function BarComponent(){
    return '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let deslocamentoDireita = 1;
            let deslocamentoEsquerda = -1;
            let indoParaDireita = true;
            const seta = document.getElementById("seta");
            const path = seta.querySelector("path");
 
            document.querySelector(".barrinha").addEventListener("click", function() {
 
                let movimento = indoParaDireita ? deslocamentoDireita : deslocamentoEsquerda;
                seta.style.transform = `translateX(${movimento}px)`;
 
                if (indoParaDireita) {
                    path.setAttribute("d", "M24.8995 16.2329C25.6972 16.6324 25.6972 17.7708 24.8995 18.1703L23.1524 19.0451C22.432 19.4059 21.584 18.8821 21.584 18.0765L21.584 16.3267C21.584 15.5211 22.432 14.9974 23.1524 15.3581L24.8995 16.2329Z");
                } else {
                    path.setAttribute("d", "M3.1005 16.2329C2.3028 16.6324 2.3028 17.7708 3.1005 18.1703L4.8476 19.0451C5.568 19.4059 6.416 18.8821 6.416 18.0765L6.416 16.3267C6.416 15.5211 5.568 14.9974 4.8476 15.3581L3.1005 16.2329Z");
                }
 
                indoParaDireita = !indoParaDireita;
            });
        });
    </script>

    <svg width="28" height="25" viewBox="0 0 28 25" class="cursor-pointer barrinha" id="barrinha">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.2077 7.08312C24.2077 7.50224 23.8159 7.84201 23.3327 7.84201H4.66602C4.18277 7.84201 3.79102 7.50224 3.79102 7.08312C3.79102 6.66399 4.18277 6.32422 4.66602 6.32422H23.3327C23.8159 6.32422 24.2077 6.66399 24.2077 7.08312Z" fill="white"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.2077 12.1424C24.2077 12.5616 23.8159 12.9013 23.3327 12.9013H4.66602C4.18277 12.9013 3.79102 12.5616 3.79102 12.1424C3.79102 11.7233 4.18277 11.3835 4.66602 11.3835H23.3327C23.8159 11.3835 24.2077 11.7233 24.2077 12.1424Z" fill="white"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M24.2077 17.2018C24.2077 17.6209 23.8159 17.9607 23.3327 17.9607H4.66602C4.18277 17.9607 3.79102 17.6209 3.79102 17.2018C3.79102 16.7827 4.18277 16.4429 4.66602 16.4429H23.3327C23.8159 16.4429 24.2077 16.7827 24.2077 17.2018Z" fill="white"/>
        <g id="seta" class="transition-transform duration-300">
            <path d="M24.8995 16.2329C25.6972 16.6324 25.6972 17.7708 24.8995 18.1703L23.1524 19.0451C22.432 19.4059 21.584 18.8821 21.584 18.0765L21.584 16.3267C21.584 15.5211 22.432 14.9974 23.1524 15.3581L24.8995 16.2329Z" fill="white" class="arrow"/>
        </g>
    </svg>
    ';
}