<?php

namespace Src\Views\Components\Utils;

function Footer()
{
    return <<<HTML
        <footer class="flex w-full min-h-40 justify-between items-center p-7 pb-0 flex-wrap gap-6 sm:gap-10 md:gap-16">
            <div class="w-32 sm:w-40 md:w-44 min-h-12">
                <img src="/VHS/public/uploads/footers/image1.svg" class="object-contain h-full mx-auto">
            </div>
            <div class="w-24 sm:w-28 md:w-32 min-h-24 sm:min-h-28">
                <img src="/VHS/public/uploads/footers/image2.svg" class="object-contain h-full mx-auto">
            </div>
        </footer>
    HTML;
}
