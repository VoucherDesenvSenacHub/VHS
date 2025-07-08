<?php

namespace Views\Components\FeaturedCard;

function FeaturedEventCard(array $event, bool $isEventPage = true): string {
    $height = $isEventPage ? 'h-[450px]' : 'h-[330px]';
    
    list($dayMonth, $time) = explode(' ', $event['date']);
    list($day, $month) = explode('-', $dayMonth);
    $fullDate = sprintf('%04d-%02d-%02d %s', 2025, $month, $day, $time);
    $date = date('d/m \à\s H:i', strtotime($fullDate));

    return <<<HTML
        <div class="relative bg-gradient-to-r from-yellow-600/40 via-orange-600/40 to-red-600/40 rounded-3xl overflow-hidden shadow-lg cursor-pointer $height">
            <img src="{$event['image_url']}" alt="{$event['title']}" class="absolute inset-0 w-full h-full object-cover opacity-70">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative z-10 p-6 h-full gap-2 flex flex-col justify-between">
                <div class="mt-auto">
                    <p class="text-white text-lg font-medium">{$event['instructor']}</p>
                    <p class="text-gray-200 text-sm">{$date} | {$event['event_type']}</p>
                </div>
                <div>
                    <h2 class="text-white text-2xl font-bold leading-tight">{$event['title']}</h2>
                </div>
            </div>
        </div>
    HTML;
}