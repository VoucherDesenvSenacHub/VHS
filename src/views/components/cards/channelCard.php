<?php
    namespace Src\Views\Components\Cards;
    require_once 'formatCard.php';

    function createChannelCard($video) {
        $thumbnail_url = htmlspecialchars($video['thumbnail_url']);
        $username = htmlspecialchars($video['username']);
        $title = htmlspecialchars($video['title']);
        $url = htmlspecialchars($video['url']);
        
        $duration = htmlspecialchars(formatTime($video['duration']));
        $visualizations = htmlspecialchars(formatViews($video['views']));
        $create_at = htmlspecialchars(formatDate($video['created_at']));
        
        return "
            <a href='$url' class='card cursor-pointer w-[320px] h-[400px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                
                <!-- Capa do vídeo -->

                <div class='relative w-full h-[50%]'>
                    <img src='$thumbnail_url' class='w-full h-full object-cover'>

                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded-md'>
                        $duration
                    </div>
                </div>

                <!-- Informações do vídeo -->

                <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                    <p class='text-gray-400 text-base'>$username</p>

                    <h3 class='text-xl leading-tight break-words overflow-hidden line-clamp-3' style='
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                        text-overflow: ellipsis;'>
                        $title
                    </h3>

                    <p class='text-gray-400 text-base'>$visualizations views • $create_at</p>
                </div>
            </a>
        ";
    }

?>