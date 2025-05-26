<?php

    namespace Src\Views\Components\Shared;
    
    function sharedComponent($url, $title) {
        $iframe = '
            <iframe width="560" height="315" src="' . htmlspecialchars($url, ENT_QUOTES) . '" frameborder="0" allowfullscreen></iframe>
        ';

        return ("
            <div class='modal-shared hidden absolute flex inset-0 overflow-hidden bg-black/25 items-center justify-center opacity-0 transition-opacity duration-500'>
                <div class='modal-content flex flex-col bg-[#1B1B1B] w-auto h-64 rounded-2xl p-6 justify-between shadow-xl scale-95 opacity-0 transition-all duration-300 transform'>
                    <div class='w-full flex flex-row justify-between items-center'>
                        <h2 class='text-white text-xl'>Compartilhar</h2>
            
                        <button onclick='closeShared()' class='flex justify-center items-center w-7 text-purple-400 hover:text-purple-600'>
                            <img src='../../../../public/icons/botaoFechar.svg' class='w-full h-full'>
                        </button>
                    </div>

                    <div class='flex justify-between'>
                        <button
                         id='incorporar'
                         title='Incorporar'
                         onclick='copyIframe(this)'
                         data-iframe=\"" . htmlspecialchars($iframe, ENT_QUOTES) . "\"
                         class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/shared/incorporar.svg'>
                        </button>

                        <a href='https://t.me/share/url?url=" . urlencode($url) . "&text=" . urlencode($title) . "'
                         id='telegram'
                         target='_blank' 
                         title='Telegram'
                         class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/shared/telegram.svg' class='w-full h-full'>
                        </a>

                        <a href='https://wa.me/?text=" . urlencode($title . ' ' . $url) . "'
                         id='whatsapp'
                         target='_blank' 
                         title='WhatsApp' 
                         class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/shared/whatsapp.svg' class='w-full h-full'>
                        </a>

                        <a href='https://www.facebook.com/sharer/sharer.php?u=" . urlencode($url) . "'
                         id='facebook'
                         target='_blank' 
                         title='Facebook'
                         class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/shared/facebook.svg' class='w-full h-full'>
                        </a>

                        
                        <a href='https://twitter.com/intent/tweet?url=" . urlencode($url) . "&text=" . urlencode($title) . "'
                         id='twitter'
                         target='_blank'
                         title='X'
                         class='flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden'>
                            <img src='../../../../public/icons/shared/twitter.svg' class='w-full h-full'>
                        </a>
                    </div>

                    <div class='flex flex-row justify-between gap-3'>
                        <input type='text' id='share-link' value='$url' class='focus:outline-none text-gray-500 text-sm p-2 w-72 border-[1px] border-[#666666] bg-transparent rounded-[10px]' readonly>
                        <button class='bg-[#6C00C0] hover:bg-[#981AFF] p-3 px-7 rounded-[10px] text-white' onclick='copyLink()'>Copiar</button>
                    </div>
                </div>
            </div>
        ");
    }

    // #

    function copyNotify() {
        return ("
            <div id='copy-notification' class='hidden overflow-hidden fixed flex bottom-0 right-0 mb-4 mr-4 min-w-20 min-h-10 bg-[#202024] rounded-xl items-center p-4 gap-4 border-b-4 border-[#660BAD] translate-y-5 opacity-0 transition-all duration-300'>
                <div class='w-12 h-12 bg-[#373450] rounded-full flex items-center justify-center p-2' style='box-shadow: 0 0 75px 0 #660BAD;'>
                    <svg width='100%' height='100%' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM11 15H9V13H11V15ZM11 11H9V5H11V11Z' fill='#660BAD'/>
                    </svg>
                </div>

                <div class='flex flex-col text-white'>
                    <h1 class='title text-xl'></h1>
                    <span class='subtitle text-gray-500 text-base'></span>
                </div>
            </div>
        ");
    }
?>

<!-- S C R I P T -->

<script>

    function openShared() {
        const overlay = document.querySelector('.modal-shared');
        const modal = overlay.querySelector('.modal-content');
        overlay.classList.remove('hidden');
        
        requestAnimationFrame(() => {
            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');

            modal.classList.remove('opacity-0', 'scale-95');
            modal.classList.add('opacity-100', 'scale-100');
        });
    }

    function closeShared() {
        const overlay = document.querySelector('.modal-shared');
        const modal = overlay.querySelector('.modal-content');

        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');

        modal.classList.remove('opacity-100', 'scale-100');
        modal.classList.add('opacity-0', 'scale-95');

        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
    }

    function copyLink() {
        const linkInput = document.getElementById('share-link');
        linkInput.select();

        navigator.clipboard.writeText(linkInput.value).then(() => {
            showNotification("Link copiado!", "O link foi copiado com sucesso");

        }).catch(err => {
            console.error('Falha ao copiar o link: ', err);
        });
    }

    function copyIframe(button) {
        const iframe = button.getAttribute('data-iframe');

        navigator.clipboard.writeText(iframe).then(() => {
            showNotification("Código copiado!", "O código foi copiado com sucesso");
        }).catch(err => {
            console.error('Erro ao copiar o iframe:', err);
        });
    }
    
</script>

<!-- # -->

<script>

    function showNotification(title, subtitle) {
        const existing = document.getElementById('copy-notification');
        if (existing) existing.remove();

        document.body.insertAdjacentHTML('beforeend', `<?= copyNotify(); ?>`);
        const notification = document.getElementById('copy-notification');

        notification.querySelector('.title').textContent = title;
        notification.querySelector('.subtitle').textContent = subtitle;

        notification.classList.remove('hidden');

        requestAnimationFrame(() => {
            notification.classList.remove('opacity-0', 'translate-y-5');
            notification.classList.add('opacity-100', 'translate-y-0');
        });

        setTimeout(() => {
            notification.classList.remove('opacity-100', 'translate-y-0');
            notification.classList.add('opacity-0', 'translate-y-5');

            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 2000);
    }

</script>