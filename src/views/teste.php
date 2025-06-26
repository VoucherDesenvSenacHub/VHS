<?php
 
 include __DIR__ . '/components/header/headerComponent.php';
 
 require "./components/fastComponent/fastComponent.php";

use function src\views\components\FastComponent\FastComponent;
use function src\views\components\header\HeaderComponent;
 
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-black">
 
<?php
 
echo HeaderComponent();
 
?>
<div class="flex items-center justify-center h-screen">

    <?=FastComponent()?>

</div>
 
</body>
</html>
 