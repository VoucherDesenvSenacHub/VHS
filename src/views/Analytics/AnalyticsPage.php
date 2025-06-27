<?php
require "../components/Perfil_Analytics/Perfil_Analytics.php";
require "../components/utils/userActivityCardsComponent.php";
require "../components/barra_admin/barra_admin.php";
require "../components/header/headerComponent.php";
require "../components/charts/chartComponent.php";
require "../components/charts/donutChartComponent.php";
require "../components/Notification_List/notificationListComponent.php";
require "../components/utils/comments/comentaryComponent.php";

use function src\views\components\utils\Comment;
use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Header\HeaderComponent;
use function src\views\components\Utils\UserActivityCardsComponent;
use function Src\Views\Components\Perfil_Analytics\renderPostComponent;
use function Src\Views\Components\Charts\renderChartComponent;
use function Src\Views\Components\Charts\renderDonutChartComponent;
use function Src\Views\Components\renderNotificationListComponent;

$seriesDataLine = [10, 15, 25, 20, 18, 12, 15];
$categoriesLine = ['SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB', 'DOM'];

$seriesDataDonut = [3320, 260, 285, 105];
$labelsDonut = ['Tecnologia', 'Moda', 'Estatística', 'Saúde'];

$notificationItems = [
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.',
    'Freitasdev baniu o usuário Crilo, motivo: incompetência.'
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Administração</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
</head>

<body
    class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">

    <!-- Header superior -->
    <?= HeaderComponent() ?>

    <div class="flex">
        <!-- Sidebar -->
        <div class="min-w-[220px] position-fixed">
            <?= Barra_Admin() ?>
        </div>

        <!-- Conteúdo principal -->
        <div class="flex-1 px-4 py-6">
            <!-- Componente de perfil -->
            <?= renderPostComponent("") ?>

            <div class = "flex flex-row gap-8">

                <div class="grid grid-col-2 h-48 gap-8">
                    
                    <div class="flex flex-row gap-4 mb-2">                    
                        
                            <?= UserActivityCardsComponent("Usuários", 11000) ?>
                        
                        
                            <?= UserActivityCardsComponent("Qtd. Vídeos", 90) ?>
                        
                        
                            <?= UserActivityCardsComponent("Parceiros", 2) ?>
                        
                        
                            <?= UserActivityCardsComponent("Canais", 12) ?>
                    </div> 
                    <div class="">
                        <?= renderChartComponent($seriesDataLine, $categoriesLine, 'Semana', 'Usuários') ?>
                    </div>

                    <div class="bg-[#1a1a1a] rounded-xl shadow-md min-h-[310px] !-gap-2">
                        <?= 
                         Comment("nome","texto"),
                         Comment("nome","texto"),
                         Comment("nome","texto")
                         ?>
                    </div>
                </div>
                <!-- Gráfico Donut junto aos cards -->
                <div class = "grid grid-row-1 gap-4">
                        <div class="bg-[#1a1a1a] rounded-xl shadow-md p-4 min-h-[400px] flex items-center justify-center mb-4">
                            <?= renderDonutChartComponent($seriesDataDonut, $labelsDonut, 'Categorias', 'Tecnologia') ?>
                        </div>
    
                        <div class="w-max bg-[#1a1a1a] rounded-xl shadow-md">
                            <?= renderNotificationListComponent($notificationItems) ?>
                        </div>
                        
                </div>
            </div>
            </div>

            

            
    </div>

</body>

</html>