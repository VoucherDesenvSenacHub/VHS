<?php
require_once __DIR__ . '/../../../components/header/headerComponent.php';
require_once __DIR__ . "/../../../components/fastComponent/fastComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";

use function src\views\components\FastComponent\FastComponent;
use function src\views\components\header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;

$fasts = $_SESSION["page_data"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/views/pages/home/fast/script.js" defer></script>
    <script src="/VHS/src/views/components/fastComponent/fastComponent.js" defer></script>
    <title>VHS - Fast</title>
</head>

<body>
    <?= HeaderComponent() ?>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>

        <section onscroll="sectionFastScroll(event)"
            class="snap-y snap-mandatory overflow-y-scroll mt-8 flex flex-col gap-8 max-w-[1500px] mx-auto w-full max-w-[30rem] max-[480px]:min-h-[calc(100vh_-_5rem)] max-[480px]:mt-0"
            style="height: calc(100vh - 10rem);">
            <?php
            foreach ($fasts as $fast) {
                echo FastComponent(
                    [
                        "id" => $fast["id"],
                        "url" => "/VHS/public/videos/" . $fast["url"] . ".mp4",
                        "title" => $fast["title"],
                        "user" => $fast["username"],
                        "avatar_url" => $fast["avatar_url"],
                        "user_liked" => $fast["user_liked"],
                        "likes" => $fast["likes"]
                    ]
                );
            }
            ?>
        </section>

    </div>

</body>

</html>