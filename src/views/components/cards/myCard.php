<?php

    require_once './formatCard.php';

    function createMyCard($video) {
        $thumbnail_url = htmlspecialchars($video['thumbnail']);
        $username = htmlspecialchars($video['username']);
        $title = htmlspecialchars($video['title']);
        $url = htmlspecialchars('#');
        $comments = htmlspecialchars(13);
        $likes = htmlspecialchars(4.5);

        $duration = formatTime($video['duration']);
        $visualizations = formatViews($video['views']);
        $create_at = formatDate($video['created_at']);
        
        return "
            <a href='$url' class='cursor-pointer w-[320px] h-[400px] bg-[#1e1e2a] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                
                <!-- Capa do vídeo -->

                <div class='relative w-full h-[50%]'>
                    <img src='$thumbnail_url' class='w-full h-full object-cover'>
                    
                    <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-sm px-2 py-1 rounded-md'>
                        $duration
                    </div>
                </div>

                <!-- Informações do vídeo -->

                <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                    <h3 class='text-xl leading-tight break-words overflow-hidden line-clamp-3' style='
                        display: -webkit-box;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical;
                        text-overflow: ellipsis;'>
                        $title
                    </h3>

                    <p class='text-gray-400 text-base'>$create_at</p>

                    <div class='flex justify-between'>
                        <div class='flex gap-2'>
                            <div>
                                <img src='../../../../public/icons/message_icon.svg' class='w-full h-full'>
                            </div>
                            <p class='text-gray-400 text-lg'>$comments</p>
                        </div>

                        <div class='flex gap-2'>
                            <div>
                                <img src='../../../../public/icons/like.svg' class='w-full h-full'>
                            </div>
                            <p class='text-gray-400 text-lg'>$likes</p>
                        </div>

                        <div class='flex gap-2'>
                            <div>
                                <img src='../../../../public/icons/eye.svg' class='w-full h-full'>
                            </div>
                            <p class='text-gray-400 text-lg'>$visualizations</p>
                        </div>
                    </div>
                </div>
            </a>
        ";
    }

?>