if (!window.cardFastScriptLoaded) {
    window.cardFastScriptLoaded = true;

    document.querySelectorAll('.current_fast').forEach(card => {
        const menuBtn = card.querySelector('.menu-btn');
        const menu = card.querySelector('.menu');
        const removeFast = card.querySelector('.remove_fast');
        const modal = card.querySelector('.modal_remove_fast');

        if (menuBtn && menu) {
            menuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                document.querySelectorAll('.menu').forEach(m => {
                    if (m !== menu) m.classList.add('hidden');
                });
                menu.classList.toggle('hidden');
            });

            menu.addEventListener('click', (e) => e.stopPropagation());
        }

        if (removeFast && modal) {
            removeFast.addEventListener('click', (e) => {
                e.stopPropagation();
                modal.classList.remove('hidden');
                if (menu) menu.classList.add('hidden');
            });

            const content = modal.querySelector('.border');
            if (content) {
                content.addEventListener('click', (e) => e.stopPropagation());
            }
        }
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('.menu').forEach(menu => menu.classList.add('hidden'));
        document.querySelectorAll('.modal_remove_fast').forEach(modal => modal.classList.add('hidden'));
    });
}
