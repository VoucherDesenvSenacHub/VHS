<?php
 
    namespace Src\Views\Components\Utils;

    function inputButton(string $icon = "", String $type, String $label, String $placeholder, String $description){
        return (
            "
            <div>
                <label>$label</label>
                <input type='$type' placeholder='$placeholder'>
            </div>
            "
        );
    }

?>
