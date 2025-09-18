<?php

namespace Src\Application\Utils;

function UploadArchives(string $file_name)
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new \Exception("Método inválido");
    }

    // Se o campo não existir ou nenhum arquivo foi enviado
    if (!isset($_FILES[$file_name]) || $_FILES[$file_name]["error"] === UPLOAD_ERR_NO_FILE) {
        return null; // 👈 não lança exceção, só retorna nulo
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

    $dir = __DIR__ . "/../../../public/uploads/";

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $safeName = uniqid() . "-" . basename($origin_name);
    $path = $dir . $safeName;

    if (!move_uploaded_file($tmp_name, $path)) {
        throw new \Exception("Falha ao salvar o arquivo");
    }

    return "/VHS/public/uploads/" . $safeName; 
}
