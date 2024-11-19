<?php 

namespace Src\Components\Utils;

function avatarStyle(){
    
    echo "
    <style>
        .circle {
            width: 3.75rem;
            height: 3.75rem;
            position: absolute;
            right: 2.27rem;
            bottom: 7.25rem;
        }
        
        .verify {
            width: 1rem;
            height: 1rem;
            position: absolute;
            right: 2.33rem;
            bottom: 7.31rem;
        }
        
        .photo {
            height: 3.12rem;
            width: 3.12rem;
            border-radius: 50%;
            object-fit: cover;
            position: absolute;
            right: 2.58rem;
            bottom: 7.56rem;
        }
    </style>
    ";
};


