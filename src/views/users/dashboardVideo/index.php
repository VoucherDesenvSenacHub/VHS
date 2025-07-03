<?php
require __DIR__ . '../components/chartsComponent/chartsComponent.php';
require __DIR__ . '../components/cardLatestVideosComponent/cardLatestVideosComponent.php';
require __DIR__ . '../components/cardLastCommentComponent/cardLastCommentComponent.php';

$videos = [
    [
        'title' => 'Vídeo 1',
        'amountPreview' => '100',
        'url' => 'https://exemplo.com/video1',
        'image' => 'https://github.com/bruna9165.png'
    ],
    [
        'title' => 'Vídeo 2',
        'amountPreview' => '200',
        'url' => 'https://exemplo.com/video2',
        'image' => 'https://github.com/bruna9165.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/bruna9165.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/bruna9165.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/bruna9165.png'
    ],
    [
        'title' => 'Vídeo 3',
        'amountPreview' => '300',
        'url' => 'https://exemplo.com/video3',
        'image' => 'https://github.com/bruna9165.png'
    ],
];

$comentarios = [
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/bruna9165.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/bruna9165.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],
    [
        'name' => 'Richard Stallman',
        'description' => 'Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!',
        'profile' => 'https://github.com/bruna9165.png',
        'commentNumber' => '4',
        'amountDay' => '4',
        'amountLike' => '8',
        'amountResponses' => '13',
    ],

];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>

<body class="bg-background">
    <div class="w-full flex justify-end">
        <div class="w-full h-full flex gap-4 p-6">
            <div class="w-[900px] flex flex-col gap-6">
                <div class="w-full">
                    <?=
                    chartsComponent();
                    ?>
                </div>
                <div class="w-full">
                    <?=
                    CardLatestVideosComponent($videos);
                    ?>
                </div>
            </div>
            <div class="w-full h-full">
                <?=
                CardLatestCommentComponent($comentarios);
                ?>
            </div>
        </div>
    </div>
</body>

</html>