<?php 

namespace Src\Components\Utils;

function avatarComponent(string $avatarUrl){

    echo "
        <div>
            <img class = 'circle' src='../../../public/icons/Circulo.svg' alt = ''>
            <img class = 'photo' src = '$avatarUrl' alt = ''>
            <img class = 'verify' src = '../../../public/icons/Verify.svg' alt = 'deu errado'>
        </div>
    ";}

