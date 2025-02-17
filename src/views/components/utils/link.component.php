<?php
namespace Src\Views\Components;
function linkComponent($icon1,$icon2,$icon3,$link1,$link2,$link3,$text1,$text2,$text3){
    return "
    <div class='flex  gap-3.5 max-w-[21rem] max-h-[7.5rem]'>
        <div class='flex gap-6 size-[1.5rem] flex-col'>
            <img class='' src='$icon1'></img>
            <img class='' src='$icon2'></img>
            <img class='' src='$icon3'></img>
        </div>
        <div class='flex gap-5.75 flex-col'>
        <a class='text-[#00DFFE]' target='_blank' href='$link1'>$text1</a>
        <a class='text-[#00DFFE]' target='_blank' href='$link2'>$text2</a>
        <a class='text-[#00DFFE]' target='_blank' href='$link3'>$text3</a>
        </div>
    </div>";

}
?>
