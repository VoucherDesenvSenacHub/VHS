<?php

namespace src\views\components\header;
require "./UltimoVideo.php";
function Card(){ 
    echo " 
    <div class='flex bg-[#1B1B1B] w-[50.75rem] h-[19.81rem] rounded-[1rem] border-1 border-[#494949] border-solid'>
    <div class='flex flex-col relative top-[0.8rem] relative left-[2rem] gap-[1.5rem]'>
        <div><p class='text-white relative bottom-[0.12rem] text-[1.2rem]'>Ultimos vídeos</p></div> " . 
        VideoCard('https://www.animeunited.com.br/oomtumtu/2021/06/photo5064584801213851896.jpg', 'chup chupshuerps', 892393)
    .   
    "</div>
    </div>
    ";
}
?>