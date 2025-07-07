<?php

namespace Src\Views\Components\Channel;

/**
 * Componente para exibir canal de criador
 * @param array $channel Array contendo os dados do canal, incluindo:
 *              - 'name': string
 *              - 'avatar_url': string
 *              - 'category': string
 *              - 'followers': int
 * @return string Retorna o HTML do canal de criador.
 */


function formatFollowers(int $followers) {
    $followersStr = strval($followers);

    if ($followers < 1000) {
        return $followersStr;
    }

    if ($followers < 10000) {
        return $followersStr[0] ."k";
    }

    if($followers < 100000) {
        return $followersStr[0] . $followersStr[1] . "k";
    }
    
    if($followers < 1000000) {
        return $followersStr[0] . $followersStr[1] . $followersStr[2] . "k";
    }

    return 1 . "M+";
}

function ChannelComponent(array $channel) {
    $channel = [
        "name" => htmlspecialchars($channel["name"]),
        "avatar_url" => htmlspecialchars($channel["avatar_url"]),
        "category" => htmlspecialchars($channel["category"]),
        "followers" => formatFollowers($channel["followers"]),  
    ];
    
    return <<<HTML
        <div class="flex gap-4 font-semibold text-xl">
            <img src='$channel[avatar_url]' class="size-20 rounded-xl" alt="" draggable="false"/>
            <div class="flex flex-col gap-0.5">
                <h3>
                    $channel[name]
                </h3>
                <p class="text-[#C4C4C4] font-medium text-sm">
                    $channel[followers] de seguidores
                </p>
                <div class="bg-[#202024] text-[#C4C4C4] text-sm text-center rounded-xl py-1">
                    $channel[category]
                </div>
            </div>
        </div>
    HTML;
}