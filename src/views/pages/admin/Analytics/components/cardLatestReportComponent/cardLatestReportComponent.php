<?php

namespace Src\Views\Components;

function cardLatestReportComponent(array $videos)
{ {
        $totalComments = array_sum(array_column($videos, 'commentNumber'));
        $html = "
            <div class='bg-[#1B1B1B] p-6 w-full rounded-xl border border-gray-700 space-y-2'>
                <style>
                    .custom-scroll::-webkit-scrollbar {
                        display: none;
                    }
                    .custom-scroll {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
                    .video-image {
                        transition: transform 0.3s ease;
                    }
                    .video-image-container:hover .video-image {
                        transform: scale(1.1);
                    }
                </style>
                    <text class='font-sans text-2xl font-bold text-white cursor-default'>Últimas Denúncias</text>
                <div class='h-52 overflow-y-auto custom-scroll'>
        ";
        foreach ($videos as $video) {
            $name = htmlspecialchars($video['name']);
            $commentNumber = htmlspecialchars($video['commentNumber']);
            $description = htmlspecialchars($video['description']);
            $profile = htmlspecialchars($video['profile']);
            $amountDay = htmlspecialchars($video['amountDay']);
            $amountLike = htmlspecialchars($video['amountLike']);
            $amountResponses = htmlspecialchars($video['amountResponses']);
            $html .= "
                    <div class='flex gap-4 justify-start hover:bg-zinc-800/50 p-2 transition-all duration-300 rounded-lg'>
                        <div class='flex flex-col justify-between'>
                            <div class='flex flex-col gap-1'>
                                <div class='flex gap-2 h-18 justify-start items-center'>
                                    <div class='flex justify-start gap-1'>
                                        <div class='w-14 h-full rounded-full overflow-hidden'>
                                            <img class='w-full h-14 rounded-full object-cover transition duration-700' src='$profile' alt='$name'>
                                        </div>
                                    </div>
                                    <div class='flex flex-col w-full gap-1'>
                                        <div class='flex gap-2'>
                                            <h2 class='font-medium text-white text-sm line-clamp-2'>$name</h2>
                                            <time class='text-slate-400 text-xs'>há $amountDay dias</time>
                                        </div>
                                        <p class='text-xs text-zinc-400 mb-2'>$description</p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            ";
        }
        $html .= "
                </div>
            </div>
        ";
        return $html;
    }
}
