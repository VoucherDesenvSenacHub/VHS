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
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white font-[Poppins]">
    <?php echo HeaderComponent(); ?>
    <div class="flex">
        <div class="max-lg:hidden">
            <?= barra_admin() ?>
        </div>
        
        <div class="p-6 pt-8 w-full flex flex-col gap-6">
            <div class="flex flex-col gap-4">
                <div>
                    <text class='font-semibold xl:text-title text-2xl text-white cursor-default'>Gerenciamento de Denúncias</text>
                </div>

                <form method="GET" class="flex flex-col gap-4">
                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                    <div class="relative w-full cursor-pointer">
                        <?= InputComponent(
                            placeholder: "Pesquisar",
                            type: "text",
                            icon: "/VHS/public/icons/Filter.svg",
                            name: "comment",
                            value: $search,
                            iconPosition: "left",
                            onClickIcon: "showFilterMenu()"
                        ) ?>

                        <?= Filter($search, $sort) ?>
                    </div>
                </form>

            </div>
            <div class="flex flex-col gap-4">
                <?php
                if (empty($comments)) {
                    echo '
                    <div class="rounded-lg border border-gray-700 bg-[#1B1B1B] p-6 text-center">
                        <p class="text-slate-400">Nenhum comentário encontrado.</p>
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
                    echo showSweetAlert("Erro ao excluir ou editar usuário", $errors, "error");
                }
                if (isset($success)) {
                    echo showSweetAlert("Sucesso ao excluir ou editar usuário", $success, "success");
                }
                ?>
            </div>
            <div>
                <?= $pagination; ?>
            </div>
        </div>
    </div>

    <div id="deleteCommentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-[#1B1B1B] border border-gray-700 rounded-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold text-white">Excluir comentário</h2>
            <p class="text-sm text-slate-400 mt-2">
                Tem certeza que deseja excluir o comentário de
                <span id="deleteCommentName" class="font-semibold text-white"></span>?
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button id="closeDeleteCommentModal" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                    Cancelar
                </button>

                <form action="/VHS/api/v1/comments/delete" method="POST">
                    <input type="hidden" name="report_id" id="deleteReportId">
                    <input type="hidden" name="comment_id" id="deleteCommentId">
                    <button type="submit" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700">
                        Sim, excluir
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="blockUserModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-[#1B1B1B] border border-gray-700 rounded-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold text-white">Inativar Usuário</h2>
            <p class="text-sm text-slate-400 mt-2">
                Tem certeza que deseja inativar o usuário
                <span id="blockUserName" class="font-semibold text-white"></span>?
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button id="closeBlockUserModal" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                    Cancelar
                </button>

                <form action="/VHS/api/v1/users/block" method="POST">
                    <input type="hidden" name="user_id" id="blockUserId">
                    <button type="submit" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700">
                        Sim, inativar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="RemoveReportModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-[#1B1B1B] border border-gray-700 rounded-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold text-white">Remover Solicitação</h2>
            <p class="text-sm text-slate-400 mt-2">
                Tem certeza que deseja remover a solicitação de
                <span id="RemoveReportUserName" class="font-semibold text-white"></span>?
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button id="closeRemoveReportModal" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                    Cancelar
                </button>

                <form action="/VHS/api/v1/comments/report/remove" method="POST">
                    <input type="hidden" name="user_id" id="RemoveReportId">
                    <button type="submit" class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700">
                        Sim, remover
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