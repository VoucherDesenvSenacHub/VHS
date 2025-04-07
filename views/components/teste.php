<?php
    // Assuming the file containing your StudioSideMenuComponent function is included at the top of this page

use function src\views\components\header\HeaderComponent;
use function src\views\components\header\StudioSideMenuComponent;
    include_once './header/headerComponent.php';
    include_once './studioSideMenu/studioSideMenuComponent.php'; // Adjust the path to where the component is located
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <!-- Add your stylesheets or any other head elements here -->
</head>

<body>
    <?php
        HeaderComponent();
        StudioSideMenuComponent();
    ?>

</body>

</html>
