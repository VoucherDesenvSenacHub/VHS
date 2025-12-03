<?php

namespace Src\Views\Components\Shared;

function sharedComponent($url, $title, $id)
{
    $iframe = '
            <iframe width="560" height="315" src="' . htmlspecialchars($url, ENT_QUOTES) . '" frameborder="0" allowfullscreen></iframe>
        ';

    return (<<<HTML
            <div id='modal-shared-{$id}' class='modal-shared hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-all duration-300'>
                <div class='modal-content bg-[#121214] border border-white/10 w-full max-w-lg rounded-2xl p-6 shadow-2xl scale-95 opacity-0 transition-all duration-300 transform'>
                    <div class='flex justify-between items-center mb-6'>
                        <h2 class='text-white text-xl font-bold'>Compartilhar</h2>
                        <button onclick='closeShared("{$id}")' class='text-gray-400 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/5'>
                            <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' />
                            </svg>
                        </button>
                    </div>

                    <div class='flex gap-4 flex-wrap'>
                        <button
                         onclick="copyIframe(this)"
                         data-iframe=""
                         class='flex flex-col items-center gap-2 group flex-grow'>
                            <div class='w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center group-hover:bg-[#6C00C0] transition-colors duration-300'>
                                <img src='/VHS/public/icons/shared/incorporar.svg' class='w-6 h-6 opacity-70 group-hover:opacity-100 group-hover:brightness-0 group-hover:invert transition-all'>
                            </div>
                            <span class='text-xs text-gray-400 group-hover:text-white transition-colors'>Incorporar</span>
                        </button>

                        <a href='https://t.me/share/url?url=" . urlencode($url) . "&text=" . urlencode($title) . "'
                         target='_blank' 
                         class='flex flex-col items-center gap-2 group flex-grow'>
                            <div class='w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center group-hover:bg-[#0088cc] transition-colors duration-300'>
                                <img src='/VHS/public/icons/shared/telegram.svg' class='w-6 h-6 opacity-70 group-hover:opacity-100 transition-all'>
                            </div>
                            <span class='text-xs text-gray-400 group-hover:text-white transition-colors'>Telegram</span>
                        </a>

                        <a href='https://wa.me/?text=" . urlencode($title . ' ' . $url) . "'
                         target='_blank' 
                         class='flex flex-col items-center gap-2 group flex-grow'>
                            <div class='w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center group-hover:bg-[#25D366] transition-colors duration-300'>
                                <img src='/VHS/public/icons/shared/whatsapp.svg' class='w-6 h-6 opacity-70 group-hover:opacity-100 transition-all'>
                            </div>
                            <span class='text-xs text-gray-400 group-hover:text-white transition-colors'>WhatsApp</span>
                        </a>

                        <a href='https://www.facebook.com/sharer/sharer.php?u=" . urlencode($url) . "'
                         target='_blank' 
                         class='flex flex-col items-center gap-2 group flex-grow'>
                            <div class='w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center group-hover:bg-[#1877F2] transition-colors duration-300'>
                                <img src='/VHS/public/icons/shared/facebook.svg' class='w-6 h-6 opacity-70 group-hover:opacity-100 transition-all'>
                            </div>
                            <span class='text-xs text-gray-400 group-hover:text-white transition-colors'>Facebook</span>
                        </a>
                        
                        <a href='https://twitter.com/intent/tweet?url=" . urlencode($url) . "&text=" . urlencode($title) . "'
                         target='_blank'
                         class='flex flex-col items-center gap-2 group flex-grow'>
                            <div class='w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center group-hover:bg-black transition-colors duration-300'>
                                <img src='/VHS/public/icons/shared/twitter.svg' class='w-6 h-6 opacity-70 group-hover:opacity-100 transition-all'>
                            </div>
                            <span class='text-xs text-gray-400 group-hover:text-white transition-colors'>X</span>
                        </a>
                    </div>

                    <div class='bg-black/20 rounded-xl p-2 flex items-center gap-2 border border-white/5 mt-8'>
                        <input type='text' id='share-link-{$id}' value='$url' class='bg-transparent text-gray-400 text-sm w-full focus:outline-none px-2' readonly>
                        <button class='bg-[#6C00C0] hover:bg-[#8000E0] text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors' onclick='copyLink("{$id}")'>
                            Copiar
                        </button>
                    </div>
                </div>
            </div>
        HTML);
}

// #

function copyNotify()
{
    return ("
            <div id='copy-notification' class='hidden fixed bottom-6 right-6 z-[110] flex items-center gap-4 bg-[#121214] border border-purple-500/50 p-4 rounded-xl shadow-2xl transform translate-y-10 opacity-0 transition-all duration-300'>
                <div class='w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center text-purple-400'>
                    <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' />
                    </svg>
                </div>

                <div class='flex flex-col'>
                    <h4 class='text-white font-semibold title'>Sucesso</h4>
                    <p class='text-gray-400 text-sm subtitle'>Link copiado para a área de transferência</p>
                </div>
            </div>
        ");
}
?>

<!-- S C R I P T -->

<script>
    function openShared(event, id) {
        if (event) event.stopPropagation();
        const overlay = document.getElementById('modal-shared-' + id);
        const modal = overlay.querySelector('.modal-content');
        overlay.classList.remove('hidden');

        requestAnimationFrame(() => {
            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');

            modal.classList.remove('opacity-0', 'scale-95');
            modal.classList.add('opacity-100', 'scale-100');
        });
    }

    function closeShared(id) {
        const overlay = document.getElementById('modal-shared-' + id);
        const modal = overlay.querySelector('.modal-content');

        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');

        modal.classList.remove('opacity-100', 'scale-100');
        modal.classList.add('opacity-0', 'scale-95');

        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
    }

    function copyLink(id) {
        const linkInput = document.getElementById('share-link-' + id);
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
            notification.classList.remove('opacity-0', 'translate-y-10');
            notification.classList.add('opacity-100', 'translate-y-0');
        });

        setTimeout(() => {
            notification.classList.remove('opacity-100', 'translate-y-0');
            notification.classList.add('opacity-0', 'translate-y-10');

            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
</script>