
<?php

// namespace src\views\components;

function CardFast(){
    return'
        <div class="w-64 h-[30rem] relative flex items-center justify-center current_fast ">
        <img src="/VHS/public/images/imgCardtst.jpg" class="object-cover h-full absolute rounded-2xl" ></img>
        
        <div class="block w-full bottom-12 absolute">

            <h2 class="text-white ml-3.5">espero vocês lá!!!</h2>

            <div class="mt-2 w-full flex justify-around absolute ">
                
                <div class=" flex items-center gap-2.5 ">
                    
                    <img src="/VHS/public/icons/fastIcon/Vector.svg" alt="coracao">
                    
                    <p class="text-sm text-white">2K</p>

                </div>

                <div class=" flex items-center gap-2.5 ">
                    
                    <img src="/VHS/public/icons/fastIcon/eyeIcon.svg" alt="eye">
                    
                    <p class="text-sm text-white">540K</p>

                </div>
 

                <img src="/VHS/public/icons/fastIcon/3botao.svg" alt=""> 


            </div>
        </div>
        
       
        
    </div>';
}
