<?php
namespace Src\Views\Components\Utils;
 
require "../../components/utils/userMenuComponent.php";
 
use function Src\Views\Components\Utils\UserMenuComponent;
?>

<script src="https://cdn.tailwindcss.com"></script>
<script src="../../../styles/tailwindglobal.js"></script>
<div>
        <?= UserMenuComponent("Bruninha67", "brunagomes9165@gmail.com", "desenvolvedora", "../../../../public/images/ProfilePhoto.png")  ?>
    </div>