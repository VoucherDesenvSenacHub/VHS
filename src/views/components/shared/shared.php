<?php

    namespace Src\Views\Components\Shared\sharedComponent;
    use Src\Views\Components\Utils\ButtonComponent;

    function sharedComponent($link = 'https://youtube.com/@freitasdev') {
        return "
            <div class='modal hidden absolute flex inset-0 overflow-hidden bg-black/25 items-center justify-center'>
                <div class='flex flex-col bg-[#1B1B1B] w-auto h-64 rounded-2xl p-6 justify-between shadow-xl'>
                    <div class='w-full flex flex-row justify-between items-center'>
                        <h2 class='text-white text-xl'>Compartilhar</h2>
            
                        <button onclick='closeShared()' class='flex justify-center items-center w-7 text-purple-400 hover:text-purple-600'>
                            <img src='../../../../public/icons/botaoFechar.svg' class='w-full h-full'>
                        </button>
                    </div>

                    <div class='flex justify-between'>
                        <button id='telegram' title='Telegram' class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/telegram.svg' class='w-full h-full'>
                        </button>

                        <button id='facebook' title='Facebook' class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/facebook.svg' class='w-full h-full'>
                        </button>

                        <button id='whatsapp' title='WhatsApp' class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/whats.svg' class='w-full h-full'>
                        </button>

                        <button id='instagram' title='Instagram' class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/insta.svg' class='w-full h-full'>
                        </button>
                        
                        <button id='twitter' title='Twitter' class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/twitter.svg' class='w-full h-full'>
                        </button>
                    </div>

                    <div class='flex flex-row justify-between gap-3'>
                        <input type='text' id='shareLink' value='$link' class='focus:outline-none text-gray-500 text-sm p-2 w-72 border-[1px] border-[#666666] bg-transparent rounded-[10px]' readonly>
                        <button class='bg-[#6C00C0] hover:bg-[#981AFF] p-3 px-7 rounded-[10px] text-white' onclick='copyLink()'>Copiar</button>
                    </div>
                </div>
            </div>
        ";
    }

    function copyNotify() {
        return "
            <div id='copyNotification' class='hidden overflow-hidden fixed flex bottom-0 right-0 mb-4 mr-4 min-w-20 min-h-10 bg-[#202024] rounded-xl items-center p-4 gap-4 border-b-4 border-[#660BAD] opacity-0 translate-y-5 transition-all duration-300'>
                <div class='w-12 h-12 bg-[#303746] rounded-full flex items-center justify-center p-2' style='box-shadow: 0 0 50px 0 #660BAD;'>
                    <svg width='100%' height='100%' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z' fill='#660BAD'/>
                    </svg>
                </div>

                <div class='flex flex-col text-white'>
                    <h1 class='text-xl'>Link copiado</h1>
                    <span class='text-gray-500 text-base'>O link foi copiado com sucesso!</span>
                </div>
            </div>
        ";
    }
?>

<!-- S C R I P T -->

<script>

    function copyLink() {
        const linkInput = document.getElementById('shareLink');
        linkInput.select();

        navigator.clipboard.writeText(linkInput.value).then(() => {

            document.body.insertAdjacentHTML('beforeend', `<?= copyNotify(); ?>`);
            const notification = document.getElementById('copyNotification');

            notification.classList.remove('hidden');
            requestAnimationFrame(() => {
                notification.classList.remove('opacity-0', 'translate-y-5');
                notification.classList.add('opacity-100', 'translate-y-0');
            });

            setTimeout(() => {
                notification.classList.remove('opacity-100', 'translate-y-0');
                notification.classList.add('opacity-0', 'translate-y-5');

                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 300);
            }, 2000);

        }).catch(err => {
            console.error('Falha ao copiar o link: ', err);
            alert('Falha ao copiar o link!');
        });
    }
    
    function openShared() {
        document.querySelector('.modal').classList.remove('hidden');
    }
    
    function closeShared() {
        document.querySelector('.modal').classList.add('hidden');
    }

</script>