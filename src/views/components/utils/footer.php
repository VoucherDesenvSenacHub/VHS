<?php

namespace Src\Views\Components\Utils;

function Footer() {
    return <<<HTML
        <footer class="flex w-full min-h-40 justify-between items-center p-7 pb-0">
            <div class="md:w-44 w-32 md:min-h-12">
                <img src="/VHS/public/uploads/footers/image1.svg" class="object-contain h-full">
            </div>

            <div class="md:w-28 md:min-h-28 w-20">
                <img src="/VHS/public/uploads/footers/image2.svg" class="object-contain h-full">
            </div>
        </footer>
    HTML;
}