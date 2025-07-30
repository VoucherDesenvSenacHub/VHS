<?php
require "/../views/components/barra_admin/barra_admin.php";
use function src\views\components\barra_admin\Barra_Admin;
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Minha Aplicação</title>
</head>
<body>
<div class="min-w-[220px] position-fixed">
            <?= Barra_Admin() ?>
        </div>
    <div id="content">
        <!-- Aqui será inserido o conteúdo específico de cada página -->
        <?php echo $content; ?>
    </div>
</body>
</html>