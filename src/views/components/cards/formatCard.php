<?php

    $videos = [
        [
        "type_card" => "Evento",
        "description" => "Gratuito",
        "duration" => 360,
        "title" => "Como aprender programação do zero e se tornar um excelente desenvolvedor full stack",
        "username" => "Canal Dev",
        "thumbnail" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "photo" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 1250000,
        "created_at" => "2024-03-10 15:00:00" 
        ]
    ];

?>

<!-- # -->

<?php

    function formatDateEvent($date) {
        $data = new DateTime($date);
        $data_formatada = $data->format("d/m/Y H:i");
        return $data_formatada;
    }

    // VERIFICAR CONTA

    function verifyTypeAccount($type) {
        if ($type == "verified") {
            return true;
        } if ($type == "padrão") {
            return false;
        }
    }

    // FORMATAÇÃO DE DURAÇÃO

    function formatTime($seconds) {

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        if ($hours > 0) {
            return sprintf("%d:%02d:%02d", $hours, $minutes, $seconds);
        }

        return sprintf("%d:%02d", $minutes, $seconds);
    }
    
    // FORMATAÇÃO DE VISUALIZAÇÕES

    function formatViews($visualizations) {

        if ($visualizations >= 1000000000) {
            return round($visualizations / 1000000000, 1) . 'B';
        } elseif ($visualizations >= 1000000) {
            return round($visualizations / 1000000, 1) . 'M';
        } elseif ($visualizations >= 1000) {
            return round($visualizations / 1000, 1) . 'K';
        }

        return $visualizations;
    }

    // FORMATAÇÃO DE DATA DE POSTAGEM

    function formatDate($date) {

        $seconds = time() - strtotime($date);
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);
        $days = floor($hours / 24);
        $weeks = floor($days / 7);
        $months = floor($days / 30);
        $years = floor($days / 365);
        
        if ($years > 0) return "$years ano(s) atrás";
        if ($months > 0) return "$months mês atrás";
        if ($months > 1) return "$months meses atrás";
        if ($weeks > 0) return "$weeks semana(s) atrás";
        if ($days > 0) return "$days dia(s) atrás";
        if ($hours > 0) return "$hours hora(s) atrás";
        if ($minutes > 0) return "$minutes minuto(s) atrás";

        return "agora mesmo";
    }

?>