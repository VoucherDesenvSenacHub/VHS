<?php

namespace Src\Views\Components;

require_once __DIR__ . "/../../../../../../application/utils/getTimeAgo.php";

use function Src\Application\Utils\getTimeAgo;

function cardLatestReportComponent(array $videos)
{ {
        $html = <<<HTML
            <div class='w-full space-y-2'>
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
                <div class='h-52 overflow-y-auto custom-scroll'>
        HTML;

        foreach ($videos as $video) {
            $name = htmlspecialchars($video['name']);
            $description = htmlspecialchars($video['text']);
            $profile = htmlspecialchars($video['user_img']);
            $amountDay = getTimeAgo($video['created_at']);

            $html .= <<<HTML
                    <div class='flex gap-4 justify-start hover:bg-zinc-800/50 p-2 transition-all duration-300 rounded-lg'>
                        <div class='flex flex-col justify-between'>
                            <div class='flex flex-col gap-1'>
                                <div class='flex gap-2 h-18 justify-start items-center'>
                                    <div class='flex justify-start gap-1'>
                                        <div class='w-14 h-full rounded-full overflow-hidden'>
                                            <img class='w-full h-14 rounded-full object-cover transition duration-700' src='/VHS/public/uploads/avatars/{$profile}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
                                        </div>
                                    </div>
                                    <div class='flex flex-col w-full gap-1'>
                                        <div class='flex gap-2'>
                                            <h2 class='font-medium text-white text-sm line-clamp-2'>{$name}</h2>
                                            <time class='text-slate-400 text-xs'>{$amountDay}</time>
                                        </div>
                                        <p class='text-xs text-zinc-400 mb-2'>{$description}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            HTML;
        }

        $html .= <<<HTML
                </div>
            </div>
        HTML;

        return $html;
    }
}
