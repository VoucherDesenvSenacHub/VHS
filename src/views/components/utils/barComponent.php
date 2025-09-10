<?php

namespace Src\Views\Components\Utils;

function BarComponent() {
    return <<<HTML
        <button class='barrinha' id='barrinha'>
            <svg width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.0009 12C25.0009 12.5523 24.5532 13 24.0009 13H4.00003C3.44792 13 3.00098 12.5521 3.00098 12C3.00098 11.4483 3.44732 11 3.99905 11H24.0009C24.5532 11 25.0009 11.4477 25.0009 12Z" fill="white"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.0009 18C25.0009 18.5523 24.5532 19 24.0009 19H4.00003C3.44792 19 3.00098 18.5521 3.00098 18C3.00098 17.4483 3.44732 17 3.99905 17H24.0009C24.5532 17 25.0009 17.4477 25.0009 18Z" fill="white"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.0009 6C25.0009 6.55228 24.5532 7 24.0009 7H4.00003C3.44792 7 3.00098 6.55211 3.00098 6C3.00098 5.44827 3.44732 5 3.99905 5H24.0009C24.5532 5 25.0009 5.44772 25.0009 6Z" fill="white"/>

                <path d="M26.5959 17.1862C27.1347 17.5973 27.1347 18.4027 26.5959 18.8138L24.6681 20.2849C23.9868 20.8048 23 20.3234 23 19.471V16.529C23 15.6766 23.9868 15.1952 24.6681 15.7151L26.5959 17.1862Z" fill="white"
                    id='arrow'
                    class='arrow transition-transform duration-500'
                    style='transform-origin: center; transform-box: fill-box;'
                />
            </svg>
        </button>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let goingLeft = true;
                const arrow = document.getElementById('arrow');

                document.querySelector('.barrinha').addEventListener('click', () => {
                    if (goingLeft) {
                        arrow.style.transform = 'translateX(-22px) rotate(-180deg)';
                    } else {
                        arrow.style.transform = 'translateX(0) rotate(0deg)';
                    }

                    goingLeft = !goingLeft;
                });
            });
        </script>
    HTML;
}