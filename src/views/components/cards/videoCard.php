<?php

    require_once './formatCard.php';

    function createVideoCard($video) {
        $thumbnail_url = $video['thumbnail'];
        $username = $video['username'];
        $photo_url = $video['photo'];
        $title = $video['title'];
        $url = '#';

        // $account_type = verificarConta($video['account_type']);
        $duration = formatTime($video['duration']);
        $visualizations = formatViews($video['views']);
        $create_at = formatDate($video['created_at']);

        if (verifyTypeAccount($video['account_type']) == true) {
            return "
                <a href='$url' class='cursor-pointer relative w-[320px] h-[400px] bg-[#1e1e2a] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                    
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

                    <!-- Foto do Usuário -->

                    <div class='absolute inset-0 imagem flex items-center justify-end p-5'>
                        <div class='w-[75px] h-[75px] flex items-center justify-center'>
                            <div class='flex w-[60px] h-[60px] absolute'>
                                <img src='$photo_url' class='w-full h-full object-cover rounded-full'>
                            </div>
                            
                            <div class='w-[75px] h-[75px] absolute'>
                                <img src='../../../../public/icons/verified.svg' class='w-full h-full'>
                            </div>
                        </div>
                    </div>
                
                </a>
            ";
        }

        if (verifyTypeAccount($video['account_type']) == false) {
            return "
                <a href='$url' class='cursor-pointer relative w-[320px] h-[400px] bg-[#1e1e2a] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                    
                    <!-- Capa do vídeo -->

                    <div class='relative w-full h-[50%]'>
                        <img src='$thumbnail_url' class='w-full h-full object-cover'>
                        <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded-md'>
                            $duration
                        </div>
                    </div>

                    <!-- Informações do vídeo -->

                    <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                        <p class='text-gray-400 text-sm'>$username</p>

                        <h3 class='text-xl leading-tight break-words overflow-hidden line-clamp-3' style='
                            display: -webkit-box;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            text-overflow: ellipsis;'>
                            $title
                        </h3>

                        <p class='text-gray-400 text-sm'>$visualizations views • $create_at</p>
                    </div>

                    <!-- Foto do Usuário -->

                    <div class='absolute inset-0 imagem flex items-center justify-end p-5'>
                        <div class='w-[75px] h-[75px] relative flex items-center justify-center'>
                            <div class='flex-1 absolute'>
                                <img src='$photo_url' class='w-full h-full object-cover rounded-full'>
                            </div>
                        </div>
                    </div>
                
                </a>
            ";
        }
    }

?>