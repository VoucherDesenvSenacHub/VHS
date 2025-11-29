<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;

use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class DeleteCommentsController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        try {
            $this->commentModel = $this->model("comment");
            $comment_delete = $this->commentModel->deleteComment($_POST["comment_id"]);
            $report_delete = $this->commentModel->deleteReportComment($_POST["report_id"]);
            if ($comment_delete && $report_delete) {
                return redirect("/VHS/admin/complaints", ["success" => "O comentario foi deletado com sucesso"]);
            }

        } catch (Error $e) {
            return redirect("/VHS/admin/complaints", ["errors" => 'Erro interno do servidor']);
        }
    }
}