<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;
use Src\Infra\Model\ChannelModel;
use Src\Infra\Model\UserModel;
use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class EditChannelController extends Controller
{
    private ChannelModel $channelModel;
    private UserModel $userModel;

    public function index()
    {
        try {
            $this->userModel = $this->model("user");
            $this->channelModel = $this->model("channel");
            $errors = [];
            $imageTypes = ["image/png", "image/jpg", "image/jpeg"];

            $avatarUrl = $_SESSION["user"]["avatar_url"] ?? "";
            $bannerUrl = $_SESSION["user"]["banner_url"] ?? "";

            if (isset($_FILES["avatar"]) && $_FILES["avatar"]["tmp_name"]) {
                $fileName = time() . "_" . uniqid() . "_" . ($_SESSION["user"]["id"] ?? "default") . ".png";
                $uploadFile = __DIR__ . "/../../../../public/uploads/avatars/" . $fileName;

                if ($_FILES["avatar"]["size"] > 6 * 1024 * 1024) {
                    $errors["avatar"] = "Arquivo muito grande (máx. 6MB)";
                }

                if (!in_array($_FILES["avatar"]["type"], $imageTypes)) {
                    $errors["avatar"] = "Tipo de arquivo inválido. Use PNG, JPG ou JPEG";
                }

                if (empty($errors["avatar"])) {
                    move_uploaded_file($_FILES["avatar"]["tmp_name"], $uploadFile);
                    $avatarUrl = $fileName;
                }
            }

            if (isset($_FILES["banner"]) && $_FILES["banner"]["tmp_name"]) {
                $fileName = time() . "_" . uniqid() . "_" . ($_SESSION["user"]["id"] ?? "default") . ".png";
                $uploadFile = __DIR__ . "/../../../../public/uploads/banners/" . $fileName;

                if ($_FILES["banner"]["size"] > 6 * 1024 * 1024) {
                    $errors["banner"] = "Arquivo muito grande (máx. 6MB)";
                }

                if (!in_array($_FILES["banner"]["type"], $imageTypes)) {
                    $errors["banner"] = "Tipo de arquivo inválido. Use PNG, JPG ou JPEG";
                }

                if (empty($errors["banner"])) {
                    move_uploaded_file($_FILES["banner"]["tmp_name"], $uploadFile);
                    $bannerUrl = $fileName;
                }
            }

            if (!empty($errors)) {
                return redirect("/VHS/studio/channel/edit", ["errors" => $errors]);
            }

            if (!isset($_POST["username"])) {
                throw new Error(serialize(["username" => "Nome do canal é obrigatório."]));
            }

            if (strlen($_POST["username"]) < 3) {
                throw new Error(serialize(["username" => "Nome deve ter no mínimo 3 caracteres."]));
            }

            if (strlen($_POST["username"]) > 24) {
                throw new Error(serialize(["username" => "Nome deve ter no máximo 24 caracteres."]));
            }


            $name = $_POST["name"] ?? $_SESSION["user"]["name"];

            if (strlen($name) < 3) {
                throw new Error(serialize(["name" => "Nome deve ter no mínimo 3 caracteres."]));
            }

            if (strlen($name) > 24) {
                throw new Error(serialize(["name" => "Nome deve ter no máximo 64 caracteres."]));
            }

            $newUsername = $_POST["username"] ?? $_SESSION["user"]["username"];
            $existing = $this->userModel->getUserByUsername($newUsername);
            if (!empty($existing) && isset($existing[0]["id"]) && ($existing[0]["id"] !== ($_SESSION["user"]["id"] ?? ""))) {
                throw new Error(serialize(["username" => "Nome do canal já existe."]));
            }

            $description = $_POST["description"] ?? $_SESSION["user"]["description_channel"] ?? "";

            $updated = $this->channelModel->updateChannel(
                $_SESSION["user"]["id"] ?? "",
                $name,
                $_POST["username"] ?? $_SESSION["user"]["username"],
                $description,
                $avatarUrl,
                $bannerUrl,
                $_POST["background_color"] ?? $_SESSION["user"]["background_color"] ?? "#100018"
            );

            if (!$updated) {
                throw new Error("Falha ao atualizar o canal.");
            }


            $_SESSION["user"]["avatar_url"] = $avatarUrl;
            $_SESSION["user"]["banner_url"] = $bannerUrl;
            $_SESSION["user"]["username"] = $_POST["username"] ?? $_SESSION["user"]["username"];
            $_SESSION["user"]["description_channel"] = $description;
            $_SESSION["user"]["background_color"] = $_POST["background_color"] ?? $_SESSION["user"]["background_color"] ?? "#100018";


            return redirect('/VHS/studio/channel/edit', ["success" => "Canal atualizado com sucesso!"]);
        } catch (Error $exception) {
            $message = $exception->getMessage();
            $errors = @unserialize($message);
            if ($errors === false) {
                $errors = ["username" => $message];
            }

            return redirect("/VHS/studio/channel/edit", [
                "errors" => $errors,
                "fields" => $_POST
            ]);
        }
    }
}
