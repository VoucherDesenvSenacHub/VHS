<?php

namespace Src\Application\Utils;

function UploadImages(string $file_name, string $user, bool $isAvatar = false, ?string $oldPath = null)
{
    $user = str_replace(" ", "_", $user);
    $user = mb_strtolower($user, "UTF-8");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new \Exception("Método inválido");
    }

    if (!isset($_FILES[$file_name]) || $_FILES[$file_name]["error"] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    $file = $_FILES[$file_name];

    if ($file["error"] !== UPLOAD_ERR_OK) {
        throw new \Exception("Erro no upload: " . $file["error"]);
    }

    $allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    if (!in_array($file["type"], $allowedTypes)) {
        throw new \Exception("Tipo de arquivo não permitido");
    }

    $maxSize = 2 * 1024 * 1024;
    if ($file["size"] > $maxSize) {
        throw new \Exception("Arquivo muito grande");
    }

    $escolha = $isAvatar ? "avatars" : "thumbs";
    $dir = __DIR__ . "/../../../public/uploads/$escolha/$user/";

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    if ($oldPath) {
        $oldFullPath = __DIR__ . "/../../../public" . str_replace("/VHS/public", "", $oldPath);
        if (file_exists($oldFullPath)) {
            unlink($oldFullPath);
        }
    }

    $safeName = time() . "-" . basename($file["name"]);
    $path = $dir . $safeName;

    if (!move_uploaded_file($file["tmp_name"], $path)) {
        throw new \Exception("Falha ao salvar o arquivo");
    }

    return "/VHS/public/uploads/$escolha/$user/" . $safeName;
}
