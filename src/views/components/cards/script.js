document.querySelectorAll('.card').forEach(card => {
    const video_options = card.querySelector('.video_options');
    const card_options = card.querySelector('.options');
    const removeVideo = card.querySelector('.remove_video');
    const modal = card.querySelector('.modal_remove_video');

    video_options.addEventListener('click', (e) => {
        e.stopPropagation();
        document.querySelectorAll('.options').forEach(m => {
            if (m !== card_options) m.classList.add('hidden');
        });
        card_options.classList.toggle('hidden');
    });

    removeVideo.addEventListener('click', (e) => {
        e.stopPropagation();
        modal.classList.toggle('hidden'); 
        card_options.classList.add('hidden');  
    });
});

document.addEventListener('click', () => {
    document.querySelectorAll('.options').forEach(menu => menu.classList.add('hidden'));
    document.querySelectorAll('.modal_remove_video').forEach(modal => modal.classList.add('hidden'));
});
