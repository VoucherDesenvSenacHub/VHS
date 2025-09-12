<?php

namespace Src\Views\Components\FeaturedCard;

function FeaturedEventCard(array $event, bool $isEventPage = true) {
    list($dayMonth, $time) = explode(' ', $event['event_date']);
    list($day, $month) = explode('-', $dayMonth);
    
    $fullDate = sprintf('%04d-%02d-%02d %s', 2025, $month, $day, $time);
    $date = date('d/m \à\s H:i', strtotime($fullDate));
    
    $height = $isEventPage ? 'h-[450px]' : 'h-[330px]';

    return <<<HTML
        <div class="relative w-full max-h-96 bg-secondary/25 rounded-3xl overflow-hidden shadow-lg cursor-pointer border-2 border-gray300/75 $height">
            <img src="{$event['thumbnail_url']}" onerror='this.src="/VHS/public/uploads/thumbs/default.png"' class="absolute inset-0 w-full h-full object-cover opacity-70">
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>

            <div class="relative z-10 p-6 h-full gap-2 flex flex-col justify-between">
                <div class="mt-auto">
                    <p class="text-white text-lg font-medium">{$event['name']}</p>
                    <p class="text-gray-200 text-sm">{$event['description']} • $date</p>
                </div>

                <div>
                    <h2 class="text-white text-2xl font-bold leading-tight line-clamp-2">{$event['title']}</h2>
                </div>
            </div>
        </div>
    HTML;
}