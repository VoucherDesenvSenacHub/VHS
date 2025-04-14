<?php

    require_once './formatCard.php';

    function createEventCard($video) {
        $thumbnail_url = $video['thumbnail'];
        $type_card = $video['type_card'];
        $title = $video['title'];
        $url = '#';
        $description = $video['description'];
        
        $visualizations = formatViews($video['views']);
        $create_at_title = formatDateEvent($video['created_at']);
        $create_at = formatDate($video['created_at']);
        
        return "
            <a href='$url' class='cursor-pointer w-[320px] h-[400px] bg-[#1e1e2a] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                
                <!-- Capa do vídeo -->

                <div class='relative w-full h-[50%]'>
                    <img src='$thumbnail_url' class='w-full h-full object-cover'>

                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-xs px-4 py-1 rounded-md'>
                        🔥  
                    </div>
                </div>

                <!-- Informações do vídeo -->

                <div class='p-3 text-white flex flex-col justify-between h-[50%]'>
                <p class='text-gray-400 text-base'>$create_at_title | $description</p>
                <p class='text-gray-400 text-base'>$type_card</p>

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