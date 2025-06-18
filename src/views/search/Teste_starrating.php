<?php
// Inclui o componente
require '../components/starrating/StarRatingComponent.php';

// Função de callback (opcional)
function meuCallback($rating) {
    echo "console.log('Avaliação selecionada: ' + $rating);";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Vídeos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Página de Vídeos</h1>
        <div class="mb-4">
            <h2 class="text-lg font-semibold">Avaliar Vídeo</h2>
            <?php
            // Renderiza o componente de estrelas
            echo \src\views\components\starrating\StarRatingComponent([
                'num_stars' => 5,
                'initial_rating' => 3,
                'star_size' => 24,
                'color_default' => 'gray-400',
                'color_active' => 'purple-600',
                'on_click_callback' => 'meuCallback'
            ]);
            ?>
        </div>
    </div>
    <script>
        function meuCallback(rating) {
            console.log('Avaliação selecionada: ' + rating);
        }
    </script>
</body>
</html>