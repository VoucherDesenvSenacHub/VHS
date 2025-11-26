<?php

namespace Src\Application\Utils;

function UploadImages(string $file_name, string $user ,bool $isAvatar = false)
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

    $origin_name = $file["name"];
    $type        = $file["type"];
    $size        = $file["size"];
    $tmp_name    = $file["tmp_name"];

    $allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    if (!in_array($type, $allowedTypes)) {
        throw new \Exception("Tipo de arquivo não permitido");
    }

    $maxSize = 2 * 1024 * 1024;
    if ($size > $maxSize) {
        throw new \Exception("Arquivo muito grande");
    }

    $escolha = "thumbs";

    $isAvatar = $isAvatar ? $escolha = "avatars" : $escolha;

    $dir = __DIR__ . "/../../../public/uploads/$escolha/$user/";

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    
    $safeName = time() . "-" . basename($origin_name);
    $path = $dir . $safeName;

    if (!move_uploaded_file($tmp_name, $path)) {
        throw new \Exception("Falha ao salvar o arquivo");
    }

    return "/VHS/public/uploads/$escolha/$user/" . $safeName;
}
