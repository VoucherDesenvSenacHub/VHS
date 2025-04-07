<?php
namespace Src\Views\Components;
function linkComponent($icon1,$link1,$text1){
    return "
    <div class='flex gap-3.5 max-w-[21rem] max-h-[1.5rem]'>
        <div class='flex gap-6 size-[1.5rem] flex-col'>
            <img class='' src='$icon1'></img>
        </div>
        <a class='text-[#00DFFE]' target='_blank' href='$link1'>$text1</a>
    </div>";

}
?>
