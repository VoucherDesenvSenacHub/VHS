<?php  

    require_once  __DIR__ . '/../components/cards/formatCard.php';

    use function Src\Views\Components\header\HeaderComponent;
    require_once __DIR__. "/../components/header/headerComponent.php";

    use function Src\Views\Components\sidebar\SidebarComponent;
    require_once __DIR__. "/../components/sidebar/barra_lateral.php";

    use function Src\Views\Components\Cards\createEventCard;
    require_once __DIR__ . "/../components/cards/eventCard.php";

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