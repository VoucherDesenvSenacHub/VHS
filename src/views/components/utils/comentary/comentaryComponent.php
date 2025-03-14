<?php
   namespace Src\Views\Components\Utils;
function comentary(){

    echo '
    <div class="w-[24.89rem] h-[6.93rem] block flex">

        <div class="w-[2.51rem] h-[2.62rem] rounded-[100%] mt-[0.31rem]">
            <img class="w-[100%] h-[100%] rounded-[100%]" src="../../../../../public/images/image.svg" alt="">
        </div>


        <div class="block ml-[0.68rem]">

            <div class="w-[19.05rem] h-[1.37rem] flex items-baseline"><p class="text-sm text-white font-semibold">João Silva</p> <p class="text-[10px] text-gray-300 font-semibold ml-[5px]">há 5 dias</p></div>

            <div class="w-[19.10rem] h-[5.31rem] mt-[0.25rem] text-[11px] font-semibold text-gray-400">Pellentesque viverra pulvinar justo nec sagittis. Nunc nec mi et dui convallis consectetur pharetra at lectus. Nunc porta urna a diam bibendum, rhoncus sollicitudin justo lacinia. Vivamus faucibus enim augue.</div>

        </div>

        <div class="w-[0.21rem] h-[1.12rem] ml-[2.37rem] mt-[0.56rem] cursor-pointer relative" id="3botao">
            <img src="3botao.svg" alt="3_botao">
        <div>
</div>


<div class="w-[4.54rem] h-[3.5rem] bg-gray-800 rounded-[0.22rem] flex items-center justify-center  border-[0.1rem] border-solid border-gray-600  top-[-0.56rem] ml-[0.25rem] absolute  hidden" id="menu">

    <ul class="w-[100%]">  
        <li class=" hover:bg-gray-700 text-white font-semibold flex justify-center items-center w-[53.57px] h-[21.45px] text-xs m-auto">

            <div>
                <img src="trash.svg" alt=
                "">
            </div>
            <div class="ml-[5px]">
                <p>Excluir</p>
            </div>
        </li>
        <li class=" hover:bg-gray-700 text-white font-semibold flex justify-center items-center w-[53px] h-[21.45px] text-xs m-auto">
            <div>
                <img src="pen.svg" alt="">
            </div>
            <div class="ml-[5px]">
                <p>Editar</p>
            </div>
        </li>
        
    </ul>    
</div>
<script src="./script.js"></script>
';

}

?>