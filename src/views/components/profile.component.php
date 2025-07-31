<?php
namespace Src\Views\Components;
function ProfileComponent($photo_profile,$creator_name,$subscribers,$category){
  return " 
    <div class='flex items-center'>
      <img class='bg-blue-500 size-14.5 rounded-2xl' src='$photo_profile' alt=''>
      <div name='content' class=''>
        <div class='relative left-2.5'>
          <h3 class='text-white text-base font-semibold'> $creator_name </h3>
          <p class='text-[#C4C4C4] font-medium text-sm'>$subscribers de seguidores</p>
      </div>
      <div class='bg-[#202024]  rounded-2xl w-25 text-center h-4 flex items-center justify-center relative left-2'>
          <p class='text-[0.62rem] text-[#C4C4C4]'> $category</p>
      </div>
      </div>
    </div>";

}
?>
