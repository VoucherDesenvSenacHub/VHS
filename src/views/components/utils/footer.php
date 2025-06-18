<?php
namespace Src\Views\Components\Utils;

function Footer() {
    return <<<HTML
        <footer class="flex w-full h-48 justify-between items-center px-0">
            <div class="w-44 h-12 ml-8">
                <img src="/VHS/public/images/imagefooter_1.png" alt="Logo da empresa VHS" class="object-contain h-full">
            </div>
            <div class="w-28 h-28 mr-2">
                <img src="/VHS/public/images/imagefooter_2.png" alt="Ícone secundário do footer" class="object-contain h-full">
            </div>
        </footer>
HTML;
}
?>