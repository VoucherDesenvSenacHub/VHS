<?php
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/barra_admin/barra_admin.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/cardDenunciationComponent.php";
require_once __DIR__ . "/../../../components/utils/coment_admin/comentAdmin.component.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/filter/filter.php";
require_once __DIR__ . "/../../../components/utils/sweetalert.php";

use function Src\Views\components\filter\Filter;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Utils\Comment;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Application\Utils\showSweetAlert;

$commets  = $_SESSION["page_data"]["comments"] ?? [];
$success = $_SESSION["redirect_data"]["success"] ?? null;
$errors = $_SESSION["redirect_data"]["errors"] ?? null;

unset($_SESSION["redirect_data"]);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
    if ($page < 1) $page = 0;
    $prevPage = $page > 1 ? $page - 1 : 0;
    $nextPage = $page + 1;
    $buttonNext = '';
    
        if (count($commets) == 7) {
            $_GET['page'] = $nextPage;
            $buttonNext = <<<HTML
                <form method="GET" style="display:inline;">
                    <input type="hidden" name="page" value="{$nextPage}">
        HTML;

            foreach ($_GET as $key => $value) {
                if ($key !== 'page') {
                    $safeKey = htmlspecialchars($key);
                    $safeVal = htmlspecialchars($value);
                    $buttonNext .= "<input type='hidden' name='{$safeKey}' value='{$safeVal}'>";
                }
            }

            $buttonNext .= <<<HTML
                    <button type="submit" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                        Próximo
                    </button>
                </form>
            HTML;
        }

        $buttonPrev = '';
        if ($page > 0) {
            $_GET['page'] = $prevPage;
            $buttonPrev = <<<HTML
                <form method="GET" style="display:inline;">
                    <input type="hidden" name="page" value="{$prevPage}">
        HTML;

            foreach ($_GET as $key => $value) {
                if ($key !== 'page') {
                    $safeKey = htmlspecialchars($key);
                    $safeVal = htmlspecialchars($value);
                    $buttonPrev .= "<input type='hidden' name='{$safeKey}' value='{$safeVal}'>";
                }
            }

            $buttonPrev .= <<<HTML
                    <button type="submit" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                        Anterior
                    </button>
                </form>
            HTML;
        }

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
                        <form method="GET">
                            <?= InputComponent(
                                placeholder: "Pesquisar",
                                type: "text",
                                name: "comment",
                                value: $_GET['comment'] ?? ""
                            ) ?>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4">
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
    
                    if ($diff < 86400) {
                        $time_ago = floor($diff / 3600) . " horas atrás";
                    }
                    if ($diff < 3600) {
                        $time_ago = floor($diff / 60) . " minutos atrás";
                    }
                    if ($diff < 60) {
                        "há" . $time_ago = $diff . " segundos atrás";
                    }
                    echo Comment(
                        $comment["name"],
                        $comment["text"],
                         $comment["thumbnail_url"],
                        "há " . $time_ago,
                        $comment["user_img"],
                        $comment["report_id"],
                        $comment["comment_id"],
                        $comment["reported_user_id"],
                        $comment["name_admin"]
                    );
                }
                if(isset($errors)){
                 echo showSweetAlert("Erro ao excluir ou editar usuário", $errors, "error");
                }
                if(isset($success)){
                 echo showSweetAlert("Sucesso ao excluir ou editar usuário", $success, "success");
                }
                ?>
            </div>
            <div class="grid grid-cols-3 items-center mt-4 text-center">
            <div class="justify-self-start">
                <?= $buttonPrev ?>
            </div>
            <div>
                <span class="text-slate-400">Página <?= $nextPage ?></span>
            </div>
            <div class="justify-self-end">
                <?= $buttonNext ?>
            </div>
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

<script>
    const deleteCommentModal = document.getElementById("deleteCommentModal");
    const closeDeleteCommentModal = document.getElementById("closeDeleteCommentModal");
    const deleteReportId = document.getElementById("deleteReportId");
    const deleteCommentId = document.getElementById("deleteCommentId");
    const deleteCommentName = document.getElementById("deleteCommentName");

    const blockUserModal = document.getElementById("blockUserModal");
    const closeBlockUserModal = document.getElementById("closeBlockUserModal");
    const blockUserId = document.getElementById("blockUserId");
    const blockUserName = document.getElementById("blockUserName");

    const RemoveReportModal = document.getElementById("RemoveReportModal");
    const closeRemoveReportModal = document.getElementById("closeRemoveReportModal");
    const RemoveReportId = document.getElementById("RemoveReportId");
    const RemoveReportUserName = document.getElementById("RemoveReportUserName");

    document.querySelectorAll(".open-delete").forEach(btn => {
        btn.addEventListener("click", () => {
            const report_id = btn.getAttribute("data-report-id");
            const comment_id = btn.getAttribute("data-comment-id");
            const name = btn.getAttribute("data-name");

            deleteReportId.value = report_id;
            deleteCommentId.value = comment_id;
            deleteCommentName.textContent = name;
            deleteCommentModal.classList.remove("hidden");
        });
    });

    closeDeleteCommentModal.addEventListener("click", () => {
        deleteCommentModal.classList.add("hidden");
    });

    document.querySelectorAll(".open-block").forEach(btn => {
        btn.addEventListener("click", () => {
            const user_id = btn.getAttribute("data-reported-user-id");
            const name = btn.getAttribute("data-reported-user-name");

            blockUserId.value = user_id;
            blockUserName.textContent = name;
            blockUserModal.classList.remove("hidden");
        });
    });

    closeBlockUserModal.addEventListener("click", () => {
        blockUserModal.classList.add("hidden");
    });

    document.querySelectorAll(".open-remove").forEach(btn => {
        btn.addEventListener("click", () => {
            const report_id = btn.getAttribute("data-report-id");
            const name = btn.getAttribute("data-name-admin");

            RemoveReportId.value = report_id;
            RemoveReportUserName.textContent = name;
            RemoveReportModal.classList.remove("hidden");
        });
    });

    closeRemoveReportModal.addEventListener("click", () => {
        RemoveReportModal.classList.add("hidden");
    });
</script>


</body>

</html>