<?php

namespace Src\Application\Controllers;

use Exception;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;
use Respect\Validation\Validator as v;
use getID3;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;

class CreateFastVideoController extends Controller {
    public FastModel $FastModel;
    public function index() {
        try{
            $uploadDir = __DIR__ . '/../../../../public/videos/';
            $thumbnailDir = __DIR__ . '/../../../../public/thumbnails/';

            $this->FastModel = $this->model("fast");

            if (!isset($_FILES['video']) || $_FILES['video']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Nenhum vídeo foi enviado ou houve um erro no upload.');
            }

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            if(!is_dir($thumbnailDir)){
                mkdir($thumbnailDir, 0777, true);
            }

            $videoFileName = $_POST['title'] . date('Y-m-d_H-i-s');
            $videoPath = $uploadDir . $videoFileName . '.mp4';
            $thumbnailPath = $thumbnailDir . $videoFileName . '.png';

            if (!move_uploaded_file($_FILES['video']['tmp_name'], $videoPath)) {
                throw new Exception('Erro ao salvar o vídeo.');
            }

            if (!isset($_POST['thumbnail']) || empty($_POST['thumbnail'])) {
                throw new Exception('Thumbnail não fornecido.');
            }

            $thumbnailData = $_POST['thumbnail'];
            $thumbnailData = preg_replace('#^data:image/\w+;base64,#i', '', $thumbnailData);
            $thumbnailData = base64_decode($thumbnailData);

            if ($thumbnailData === false || !file_put_contents($thumbnailPath, $thumbnailData)) {
                throw new Exception('Erro ao salvar o thumbnail.');
            }

            $getID3 = new getID3();
            $videoInfo = $getID3->analyze($videoPath);
            $duration = isset($videoInfo['playtime_seconds']) ? (int)$videoInfo['playtime_seconds'] : 0;

            $id = uniqid() . uniqid();

            $schema = v::key(
                'title',v::stringType()->length(3, 64)->setTemplate( 'O titulo tem que ter entre 3 a 32 caracteres')
            );
            
            $schema->assert($_POST);

            $id = uniqid().uniqid();

            $this->FastModel->createFastVideo($id,  $_POST["title"], $_SESSION["user"]["id"], $duration,  0, $videoFileName, $videoFileName);
            
            redirect("/VHS/studio/create/fast?success=1", ['success' => 'Vídeo criado com sucesso!']);
        }
        catch (NestedValidationException | Exception $exception) {

            if($exception instanceof NestedValidationException) {
                foreach ($exception->getMessages() as $message) {
                    $messages[] = $message;
                }
                return redirect("/VHS/studio/create/fast?error=1", ['errors' => $messages[0], 'fields' => $_POST['title']]);
            }
            
            return redirect("/VHS/studio/create/fast?error=1", ['errors' => $exception->getMessage(), 'fields' => $_POST['title']]);
        }
    }
}
