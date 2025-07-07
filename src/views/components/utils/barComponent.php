<?php

    namespace Src\Views\Components\Utils;

    function BarComponent() {
        return "
            <button class='barrinha' id='barrinha'>
                <svg width='28' height='25' viewBox='0 0 28 25' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path fill-rule='evenodd' clip-rule='evenodd' d='M25.0007 12V12C25.0007 12.5523 24.553 13 24.0007 13H3.99978C3.44767 13 3.00073 12.5521 3.00073 12V12V12C3.00073 11.4483 3.44707 11 3.9988 11H24.0007C24.553 11 25.0007 11.4477 25.0007 12V12Z' fill='white'/>
                    <path fill-rule='evenodd' clip-rule='evenodd' d='M25.0007 18V18C25.0007 18.5523 24.553 19 24.0007 19H3.99978C3.44767 19 3.00073 18.5521 3.00073 18V18V18C3.00073 17.4483 3.44707 17 3.9988 17H24.0007C24.553 17 25.0007 17.4477 25.0007 18V18Z' fill='white'/>
                    <path fill-rule='evenodd' clip-rule='evenodd' d='M25.0007 6V6C25.0007 6.55228 24.553 7 24.0007 7H3.99978C3.44767 7 3.00073 6.55211 3.00073 6V6V6C3.00073 5.44827 3.44707 5 3.9988 5H24.0007C24.553 5 25.0007 5.44772 25.0007 6V6Z' fill='white'/>
                    
                    <path
                     id='seta'
                     class='transition-transform duration-500'
                     d='M1.02937 18.7924C0.509357 18.3921 0.509358 17.6079 1.02937 17.2076L2.89001 15.7753C3.54758 15.2691 4.5 15.7378 4.5 16.5677V19.4323C4.5 20.2622 3.54757 20.7309 2.89001 20.2247L1.02937 18.7924Z'
                     fill='white'
                     style='transform-origin: center; transform-box: fill-box;'
                    />
                </svg>
            </button>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    let indoParaDireita = true;
                    const seta = document.getElementById('seta');

                    document.querySelector('.barrinha').addEventListener('click', () => {
                        if (indoParaDireita) {
                            seta.style.transform = 'translateX(22px) rotate(180deg)';
                        } else {
                            seta.style.transform = 'translateX(0) rotate(0deg)';
                        }

                        indoParaDireita = !indoParaDireita;
                    });
                });
            </script>
        ";
    }

?>