<?php  

    require_once  __DIR__ . '/../components/cards/formatCard.php';
    require_once __DIR__ . "/../components/cards/eventCard.php";

    require_once __DIR__ . "/../components/header/headerComponent.php";
    use function Src\Views\Components\header\HeaderComponent;

    require_once __DIR__ . "/../components/sidebar/barra_lateral.php";
    use function Src\Views\Components\sidebar\SidebarComponent;

    $videos = [
        [
            "url" => "https://youtube.com/@freitasdev",
            "type_card" => "Evento",
            "description" => "Gratuito",
            "duration" => 360,
            "title" => "Como aprender programação do zero e se tornar um excelente desenvolvedor full stack",
            "username" => "Canal Dev",
            "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
            "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
            "account_type" => "verified",
            "views" => 1250000,
            "created_at" => "2024-03-10 15:00:00" 
        ]
    ];

?>

<!-- H T M L -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#0C0118]">

    <?= HeaderComponent(); ?>
    <?= SidebarComponent(); ?>

    <?php
        foreach ($videos as $video) {
            createEventCard($video);
        }
    ?>

</body>
</html>