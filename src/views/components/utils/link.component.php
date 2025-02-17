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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/global.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body class="bg-black">
    <?= linkComponent("../../../../public/icons/lupa.svg","https://www.youtube.com/","youtube") ?>
</body>
</html>
