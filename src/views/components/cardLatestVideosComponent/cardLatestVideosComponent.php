<?php
// EXEMPLO DE USO DO COMPONENTE

// require __DIR__ . '/../../components/cardLatestVideosComponent/cardLatestVideosComponent.php';

// $videos = [
//     [
//         'title' => 'Vídeo 1',
//         'amountPreview' => '100',
//         'url' => 'https://exemplo.com/video1'
//     ],
//     [
//         'title' => 'Vídeo 2',
//         'amountPreview' => '200',
//         'url' => 'https://exemplo.com/video2'
//     ],
//     [
//         'title' => 'Vídeo 3',
//         'amountPreview' => '300',
//         'url' => 'https://exemplo.com/video3'
//     ],
//     [
//         'title' => 'Vídeo 3',
//         'amountPreview' => '300',
//         'url' => 'https://exemplo.com/video3'
//     ],
//     [
//         'title' => 'Vídeo 3',
//         'amountPreview' => '300',
//         'url' => 'https://exemplo.com/video3'
//     ],
//     [
//         'title' => 'Vídeo 3',
//         'amountPreview' => '300',
//         'url' => 'https://exemplo.com/video3'
//     ],
// ];

// echo CardLatestVideosComponent($videos);

function CardLatestVideosComponent(array $videos) {
    $html = "
        <div class='bg-[#1B1B1B] p-6 w-1/2 rounded-xl border border-gray-700 space-y-2'>
            <style>
                .custom-scroll::-webkit-scrollbar {
                    display: none; /* Hide scrollbar for Chrome, Safari, and newer Edge */
                }
                .custom-scroll {
                    -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
                    scrollbar-width: none; /* Hide scrollbar for Firefox */
                }
                .video-image {
                    transition: transform 0.3s ease;
                }
                .video-image-container:hover .video-image {
                    transform: scale(1.1);
                }
            </style>
            <div class='flex items-center justify-between w-full'>
                <text class='font-sans text-2xl font-bold text-white cursor-default'>Últimos Vídeos</text>
                <a href='#' class='text-sm font-medium text-zinc-400 hover:text-white transition-all duration-300'>Ver todos</a>
            </div>
            <div class='h-96 overflow-y-auto custom-scroll'>
    ";
    foreach ($videos as $video) {
        $title = htmlspecialchars($video['title']);
        $amountPreview = htmlspecialchars($video['amountPreview']);
        $url = htmlspecialchars($video['url']);
        $image = htmlspecialchars($video['image']);
        $html .= "
                <a href='$url' class='flex gap-4 justify-start hover:bg-zinc-800/50 p-3 transition-all duration-300 rounded-lg' >
                    <div class='w-40 h-24 rounded-lg bg-red-500 overflow-hidden relative video-image-container'>
                        <img class='w-full h-full object-cover transition duration-700 ease-in' src='$image' alt='$title'>
                    </div>
                    <div class='flex flex-col justify-between'>
                        <div>
                            <h2 class='font-medium text-white line-clamp-2'>$title</h2>
                            <div class='flex items-center gap-1'>
                                <img class='w-3 h-3' src='../../../../public/icons/eye.svg' alt=''>
                                <p class='text-xs text-zinc-400'>$amountPreview visualizações</p>
                            </div>
                        </div>
                        <div class='mt-1 flex gap-1'>
                            <div class='flex items-center gap-1 hover:bg-zinc-700/50 transition-all duration-200 rounded-lg p-1'>
                                <img class='w-4 h-4' src='../../../../public/icons/pencill.svg' alt=''>
                                <span class='text-xs text-zinc-400'>Editar</span>
                            </div>
                            <div class='flex items-center gap-1 hover:bg-zinc-700/50 transition-all duration-200 rounded-lg p-1'>
                                <img class='w-4 h-4' src='../../../../public/icons/messageCircleMoree.svg' alt=''>
                                <span class='text-xs text-zinc-400'>Comentários</span>
                            </div>
                        </div>
                    </div>
                </a>
        ";
    }
    $html .= "
            </div>
        </div>
    ";
    return $html;
}
?>