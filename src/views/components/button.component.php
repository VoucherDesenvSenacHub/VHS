<?php
    namespace Src\Components\Utils;

    function buttonComponent(bool | null $outline, string $text, string | null $icon) {
        $outline = $outline ? "btn-outline" : '';
        $div = $outline ? "btn-div-outline" : '';
        $icon = $icon ? "<img src='$icon'/>" : '';

        echo "
        <div class='btn-div $div'>
            <link rel='stylesheet' href='../../styles/global.css'>
            <button class='btn $outline'>$text</button>
            $icon
        </div>
        ";
    }
?>