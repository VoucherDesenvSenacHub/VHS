<?php

namespace Views\Components\FeaturedCard;

function FeaturedEventCard(array $event, bool $isEventPage = true): string {
    $height = $isEventPage ? 'h-[450px]' : 'h-[330px]';
    $date = date('d/m/Y', strtotime($event['date']));

    return <<<HTML
        <div class="relative bg-gradient-to-r from-red-600/20 to-purple-600/20 rounded-3xl overflow-hidden shadow-lg cursor-pointer $height">
            <img src="{$event['image_url']}" alt="{$event['title']}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative z-10 p-6 h-full flex flex-col justify-end">
            <h2 class="text-white text-lg 2xl:text-xl font-bold leading-tight line-clamp-2">{$event['title']}</h2>
                <div class="flex items-center gap-3 mb-3">
                    <div>
                        <p class="text-white text-sm font-medium">{$event['instructor']}</p>
                        <p class="text-gray-300 text-xs">{$event['event']} • {$date}</p>
                    </div>
                </div>
            </div>
        </div>
    HTML;
}