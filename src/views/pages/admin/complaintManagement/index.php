<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/barra_admin/barra_admin.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/cardDenunciationComponent.php";
require_once __DIR__ . "/../../../components/utils/coment_admin/comentAdmin.component.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/filter/filter.php";

use function Src\Views\components\filter\Filter;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Utils\Comment;
use function Src\Views\Components\Utils\InputComponent;

$commets  = $_SESSION["page_data"]["comments"] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white font-[Poppins]">
    <?php echo HeaderComponent(); ?>
    <div class="flex gap-10">
        <?= barra_admin() ?>
        <div class="p-6 pt-8 w-full flex flex-col gap-6">
            <div class="flex flex-col gap-4">
                <div>
                    <text class='text-3xl font-bold text-white cursor-default'>Gerenciamento de Usuários</text>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex gap-2 w-96">
                        <?php echo ButtonComponent("Usuários", "studio", "", 13, 2.5, "", "/VHS/admin/users"); ?>
                        <?php echo ButtonComponent("Denúncias", "studio", "", 13, 2.5, "", "/VHS/admin/complaints"); ?>
                    </div>
                    <div class="flex items-center justify-center gap-4">
                        <div class="h-full pt-6">
                            <?= Filter() ?>
                        </div>
                        <div class="w-full">
                            <?= InputComponent(placeholder: "Pesquisar", type: "text") ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="colocaraqui  flex flex-col gap-4">
                <?php
                if(empty($commets)) {
                    echo "Nenhum comentário reportado encontrado";
                }
                $tz = new DateTimeZone('America/Campo_Grande');
                foreach ($commets as $comment) {
                    $created = new DateTime($comment["created_at"], $tz);
                    $now = new DateTime('now', $tz);
                    $diff = $now->getTimestamp() - $created->getTimestamp();

                    $time_ago = floor($diff / 86400) . " dias atrás";
                    if ($diff < 60) {
                       "há" . $time_ago = $diff . " segundos atrás";
                    }
                    if ($diff < 3600) {
                        $time_ago = floor($diff / 60) . " minutos atrás";
                    }   
                    if ($diff < 86400) {
                        $time_ago = floor($diff / 3600) . " horas atrás";
                    }
                    echo Comment(
                        $comment["name"],
                        $comment["text"],
                         $comment["thumbnail_url"],
                        "há " . $time_ago,
                        $comment["user_img"]
                    );
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>