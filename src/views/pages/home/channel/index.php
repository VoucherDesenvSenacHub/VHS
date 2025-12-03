<?php

require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/fastComponent/fastComponent.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\viewCards;
use function Src\Views\Components\FastComponent\FastComponent;
use function Src\Application\Utils\paginate;
use function Src\Views\Components\Utils\ButtonComponent;

$user = $data['user'];
$content = $data['content'];
$tab = $data['tab'];
$existsNextPage = $data['existsNextPage'];
$page = $data['page'];
$username = $data['user']['username'];
$isFollowing = $data['isFollowing'] ?? false;
$user['avatar_url'] = '/VHS/public/uploads/avatars/' . $user['avatar_url'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - <?= htmlspecialchars($user['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src="/VHS/src/views/pages/home/fast/script.js" defer></script>
    <script src="/VHS/src/views/components/fastComponent/fastComponent.js" defer></script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="w-full min-h-screen bg-no-repeat bg-cover bg-center text-white" style="background: linear-gradient(to bottom, <?= $user['background_color'] ?? '#20002c' ?>, #13001aff);">
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">
        <div>
            <?= SidebarComponent() ?>
        </div>

        <main class="flex-1 px-4 sm:px-6 py-4 max-w-[1500px] mx-auto w-full">

            <!-- Channel Header -->
            <div class="mb-8">
                <div class="h-32 md:h-48 bg-gradient-to-r from-purple-900 to-blue-900 rounded-xl mb-[-3rem] overflow-hidden relative">
                    <?php if (!empty($user['banner_url'])): ?>
                        <img src="/VHS/public/uploads/banners/<?= $user['banner_url'] ?>" class="w-full h-full object-cover absolute inset-0">
                    <?php endif; ?>
                </div>
                <div class="pl-6 flex flex-col sm:flex-row items-start sm:items-end gap-4">
                    <img src="<?= $user['avatar_url'] ?? '/VHS/public/uploads/avatars/default.png' ?>"
                        onerror="this.src='/VHS/public/uploads/avatars/default.png'"
                        class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 object-cover relative"
                        style="border-color: <?= $user['background_color'] ?? '#20002c' ?>; background-color: <?= $user['background_color'] ?? '#20002c' ?>;"
                        alt="<?= $user['name'] ?>">

                    <div class="flex-1 mb-2">
                        <h1 class="text-2xl md:text-3xl font-bold relative z-50"><?= ($user['name']) ?></h1>
                        <p class="text-gray-400">@<?= ($user['username']) ?></p>
                        <div class="flex items-center gap-4 mt-2 text-sm text-gray-300">
                            <span><?= $user['followers'] ?> seguidores</span>
                            <span class="bg-white/10 px-2 py-0.5 rounded text-xs"><?= ($user['category']) ?></span>
                        </div>
                    </div>

                    <!-- Subscribe Button -->
                    <div class="flex flex-col gap-2 w-full max-w-[12rem]">
                        <?php if ($user['id'] != $_SESSION['user']['id']): ?>
                            <div id="subscribeContainer" onclick="toggleSubscribe('<?= $user['id'] ?>')">
                                <?= ButtonComponent(
                                    text: $isFollowing ? 'Inscrito' : 'Inscrever-se',
                                    variant: $isFollowing ? 'default' : 'outline',
                                    className: " w-full rounded-xl"
                                )
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b border-white/10 mb-6">
                <div class="flex gap-6">
                    <a href="?tab=videos&username=<?= $username ?>" class="pb-3 px-2 border-b-2 transition-colors <?= $tab === 'videos' ? 'border-purple-500 text-white' : 'border-transparent text-gray-400 hover:text-white' ?>">
                        Vídeos
                    </a>
                    <a href="?tab=fasts&username=<?= $username ?>" class="pb-3 px-2 border-b-2 transition-colors <?= $tab === 'fasts' ? 'border-purple-500 text-white' : 'border-transparent text-gray-400 hover:text-white' ?>">
                        Fasts
                    </a>
                </div>
            </div>

            <!-- Content -->
            <?php if (empty($content)): ?>
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <img src="/VHS/public/icons/search-empty.svg" onerror="this.style.display='none'" class="w-32 h-32 mb-4 opacity-50">
                    <h3 class="text-xl font-semibold text-gray-300">Nenhum conteúdo encontrado</h3>
                    <p class="text-gray-500 mt-2">Este canal ainda não publicou <?= $tab === 'videos' ? 'vídeos' : 'fasts' ?>.</p>
                </div>
            <?php else: ?>
                <?php if ($tab === 'videos'): ?>
                    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?= viewCards($content, 'videos') ?>
                    </section>
                <?php else: ?>
                    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?= viewCards($content, 'fasts') ?>
                    </section>
                <?php endif; ?>

                <div class="mt-8 mb-8">
                    <?= paginate($content, $existsNextPage) ?>
                </div>
            <?php endif; ?>

        </main>
    </div>

    <script>
        async function toggleSubscribe(followingId) {
            const container = document.getElementById('subscribeContainer');
            const btn = container.querySelector('button') || container.querySelector('div'); // ButtonComponent might render a div or button
            const isFollowing = btn.innerText.trim() === 'Inscrito';
            const url = isFollowing ? '/VHS/api/v1/json/user/unfollow' : '/VHS/api/v1/json/user/follow';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        following_id: followingId
                    })
                });

                const data = await response.json();

                if (data.success) {
                    if (isFollowing) {
                        btn.innerText = 'Inscrever-se';
                        btn.classList.remove("bg-purple-700");
                        btn.classList.add("border-purple-700");
                        btn.classList.add("border");
                    } else {
                        btn.innerText = 'Inscrito';
                        btn.classList.add("bg-purple-700");
                    }
                } else {
                    console.error('Action failed:', data.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</body>

</html>