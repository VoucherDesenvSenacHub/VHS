<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/barra_admin/barra_admin.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/cardDenunciationComponent.php";
require_once __DIR__ . "/../../../components/utils/coment_admin/comentAdmin.component.php";
require_once __DIR__ . "/../../../components/filter/filter.php";
require_once __DIR__ . "/../../../components/utils/sweetalert.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";
require_once __DIR__ . "/../../../../application/utils/getTimeAgo.php";

use function Src\Views\components\filter\Filter;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Utils\Comment;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Application\Utils\showSweetAlert;
use function Src\Application\Utils\paginate;
use function Src\Application\Utils\getTimeAgo;

$comments  = $_SESSION["page_data"]["comments"] ?? [];
$next_page_report_comments = $_SESSION["page_data"]["next_page_report_comments"] ?? 0;
$search = $_SESSION["page_data"]["search"] ?? '';
$sort = $_SESSION["page_data"]["sort"] ?? 'desc';

$success = $_SESSION["redirect_data"]["success"] ?? null;
$errors = $_SESSION["redirect_data"]["errors"] ?? null;

$pagination = paginate($comments, $next_page_report_comments);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de denúncias</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden font-[Poppins]">
    <?php echo HeaderComponent(); ?>

    <div class="flex flex-col md:flex-row w-full">
        <div class="hidden md:block">
            <?= barra_admin() ?>
        </div>

        <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-white">Gerenciamento de Denúncias</h1>
                    <p class="text-gray-400 mt-1">Analise e modere os comentários reportados</p>
                </div>
            </div>

            <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">
                <div class="flex flex-col md:flex-row gap-4 mb-8 items-center justify-between">
                    <div class="w-full">
                        <form method="GET" class="w-full relative">
                            <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                            <?= InputComponent(
                                placeholder: "Pesquisar denúncias...",
                                type: "text",
                                name: "comment",
                                value: $search,
                                icon: "/VHS/public/icons/filter.svg",
                                iconPosition: "left",
                                width: "full",
                                onClickIcon: "showFilterMenu()"
                            ) ?>
                            <?= Filter($search, $sort) ?>
                        </form>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <?php
                    if (empty($comments)) {
                        echo '
                        <div class="rounded-2xl border border-white/5 bg-[#121214] p-12 text-center">
                            <div class="flex flex-col items-center justify-center gap-4">
                                <div class="p-4 rounded-full bg-white/5">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-white">Nenhuma denúncia encontrada</h3>
                                    <p class="text-gray-400 mt-1">Tudo limpo por aqui! 🎉</p>
                                </div>
                            </div>
                        </div>';
                    }
                    foreach ($comments as $comment) {
                        $time_ago = getTimeAgo($comment["created_at"]);
                        echo Comment(
                            $comment["name"],
                            $comment["text"],
                            $comment["thumbnail_url"],
                            $time_ago,
                            $comment["user_img"],
                            $comment["report_id"],
                            $comment["comment_id"],
                            $comment["reported_user_id"],
                            $comment["name_admin"]
                        );
                    }
                    if (isset($errors)) {
                        echo showSweetAlert("Erro ao processar ação", $errors, "error");
                    }
                    if (isset($success)) {
                        echo showSweetAlert("Sucesso", $success, "success");
                    }
                    ?>
                </div>

                <div class="mt-6">
                    <?= $pagination; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Modals -->
    <div id="deleteCommentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm transition-all duration-300">
        <div class="bg-[#121214] border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-100 transition-all">
            <div class="flex flex-col items-center text-center gap-4">
                <div class="p-3 bg-red-500/10 rounded-full">
                    <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Excluir Comentário</h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Tem certeza que deseja excluir o comentário de <span id="deleteCommentName" class="font-semibold text-white"></span>?
                    </p>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button id="closeDeleteCommentModal" class="flex-1 h-full px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                    Cancelar
                </button>
                <form class="flex-1" action="/VHS/api/v1/comments/delete" method="POST">
                    <input type="hidden" name="report_id" id="deleteReportId">
                    <input type="hidden" name="comment_id" id="deleteCommentId">
                    <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white transition-colors font-medium shadow-lg shadow-red-500/20">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="blockUserModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm transition-all duration-300">
        <div class="bg-[#121214] border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-100 transition-all">
            <div class="flex flex-col items-center text-center gap-4">
                <div class="p-3 bg-red-500/10 rounded-full">
                    <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Inativar Usuário</h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Tem certeza que deseja inativar o usuário <span id="blockUserName" class="font-semibold text-white"></span>?
                    </p>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button id="closeBlockUserModal" class="flex-1 h-full px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                    Cancelar
                </button>
                <form class="flex-1" action="/VHS/api/v1/users/block" method="POST">
                    <input type="hidden" name="user_id" id="blockUserId">
                    <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white transition-colors font-medium shadow-lg shadow-red-500/20">
                        Inativar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="RemoveReportModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm transition-all duration-300">
        <div class="bg-[#121214] border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-2xl transform scale-100 transition-all">
            <div class="flex flex-col items-center text-center gap-4">
                <div class="p-3 bg-green-500/10 rounded-full">
                    <svg class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Remover Solicitação</h2>
                    <p class="text-sm text-gray-400 mt-2">
                        Deseja remover a denúncia de <span id="RemoveReportUserName" class="font-semibold text-white"></span> e manter o comentário?
                    </p>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button id="closeRemoveReportModal" class="flex-1 h-full px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                    Cancelar
                </button>
                <form class="flex-1" action="/VHS/api/v1/comments/report/remove" method="POST">
                    <input type="hidden" name="user_id" id="RemoveReportId">
                    <button type="submit" class="w-full px-4 h-full py-2.5 rounded-xl bg-green-600 hover:bg-green-700 text-white transition-colors font-medium shadow-lg shadow-green-600/20">
                        Manter
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="/VHS/src/views/pages/admin/complaintManagement/script.js"></script>
    <script defer>
        const input = document.querySelector("input[name='comment']");
        let timeout = null;

        input.addEventListener("input", () => {
            clearTimeout(timeout);

            timeout = setTimeout(() => {
                input.form.submit();
            }, 1500);
        });
    </script>
</body>
<?php
unset($_SESSION["redirect_data"]);

if (!isset($_GET['comment'])) {
    unset($_SESSION['page_data']['search']);
}
?>

</html>