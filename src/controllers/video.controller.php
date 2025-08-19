<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../application/core/controller.php';

use Src\Application\Core\Controller;
use Src\Infra\Models\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

use function Src\Application\Utils\UploadArchives;

class VideoController extends Controller{
    
    public VideoModel $videoModel;

    public function index()
    {
        try {
            $this->videoModel = $this->model("video");

            // 1. Upload da imagem
            $imgPath = UploadArchives('thumbnail'); // retorna "/uploads/xxxx.png"

            // 2. Junta POST com o thumbnail_url
            $data = array_merge($_POST, [
                "thumbnail_url" => $imgPath
            ]);

            // 3. Validação
            $schema = v::key('url', v::stringType())
                ->key('title', v::stringType())
                ->key('description', v::stringType())
                // ->key('author_id', v::stringType())
                ->key('category_id', v::stringType())
                // ->key('type', v::stringType())       
                ->key('thumbnail_url', v::stringType());

            $schema->assert($data);

            // 4. Criação no banco
            $this->videoModel->create(
                $data["url"],
                $data["title"],
                $data["description"],
                $data["category_id"],
                $data["thumbnail_url"]
            );

            echo "Vídeo criado com sucesso!";
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }
}
