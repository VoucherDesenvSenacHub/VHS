<?php 

    namespace src\views\components\header;
    function VideoCard($urlThumb, $title, $viewsCont){ 
        $viewsCountElement = "";
        $viewsCountTitle = number_format($viewsCont);

        if($viewsCont < 100000){
            $viewsCountStr = strval($viewsCont);
            $viewsCountElement = $viewsCountStr[0] . $viewsCountStr[1] . 'k';
        }
        elseif($viewsCont < 1000000){
            $viewsCountStr = strval($viewsCont);
            $viewsCountElement = $viewsCountStr[0] . $viewsCountStr[1] . $viewsCountStr[2] . 'k';
        }
        return " 
        <div class='flex items-center gap-[0.65rem]'>
            <div><img src='$urlThumb' alt='' class='w-[7.5rem] h-[3.5rem] rounded-[0.30rem]'></div>
        <div>
            <div><p class='text-white'>$title</p></div>
            <div><p class='text-gray-200 text-[0.8rem]' title='$viewsCountTitle visualizações'>$viewsCountElement visualizações</p></div>
            <div class='flex gap-[0.3rem]'><a href=''><img src='../../../../public/icons/lapis.svg' alt=''></a><a href=''><img src='../../../../public/icons/graficoquadratico.svg' alt=''></a><a href=''><img src='../../../../public/icons/comentariocomental.svg' alt=''></a></div>
        </div>
        </div>
    ";
    }
?>
