<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;

use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/helpers/verifyRecaptcha.php';

class DeleteReportCommentsController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        try {
            $this->commentModel = $this->model("comment");
            $report_remove = $this->commentModel->deleteReportComment($_POST["user_id"]);
            if ($report_remove) {
                return redirect("/VHS/admin/complaints", ["success" => "O comentário continua sendo exibido"]);
            }

        } catch (Error $e) {
            return redirect("/VHS/admin/complaints", ["errors" => 'Erro interno do servidor']);
        }
    }
}