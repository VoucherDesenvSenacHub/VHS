<?php

namespace Src\Components\Utils;

function buttonStyle() {
    echo"
    <style>
        .btn-div {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border: 1px solid var(--primary);
            border-radius: 5px;
            padding: 0.4rem;
            background-color: var(--primary);
        }

        .btn-div-outline {
            background: none;
            color: var(--secondary);
        }

        .btn-div .icon {
            position: absolute;
            right: 0.5rem;
        }

        .btn {
            cursor: pointer;
            transition: 0.2s ease-in-out all;
            border: none;
            padding: 0rem 0.4rem;
            font-size: var(--paragraph-size);
            font-weight: 600;
            color: var(--secondary);
            background: none;
        }

        .btn-outline {
            background: none;
            color: var(--secondary);
        }
    </style>
    ";
}