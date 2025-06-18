<?php
namespace src\views\components\starrating;

function StarRatingComponent(array $config = [])
{
    $defaults = [
        'id' => 'star-rating-' . uniqid(),
        'num_stars' => 5,
        'star_size' => 24,
        'color_default' => 'gray-400',
        'color_active' => 'purple-600',
        'initial_rating' => 0,
        'on_click_callback' => '',
    ];
    $config = array_merge($defaults, $config);
    ob_start();
    ?>
    <div class="star-rating inline-flex gap-1.5 justify-end w-full" id="<?php echo htmlspecialchars($config['id']); ?>"
        role="radiogroup" aria-label="Classificação por estrelas">
        <?php for ($i = 1; $i <= $config['num_stars']; $i++):
            $is_active = $i <= $config['initial_rating'] ? 'active' : ''; ?>
            <span class="star cursor-pointer transition-transform duration-200 <?php echo $is_active; ?>"
                data-rating="<?php echo $i; ?>" role="radio" aria-checked="<?php echo $is_active ? 'true' : 'false'; ?>"
                tabindex="0">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="star-svg w-<?php echo $config['star_size'] / 4; ?> h-<?php echo $config['star_size'] / 4; ?> stroke-<?php echo $config['color_default']; ?> <?php echo $is_active ? 'fill-' . $config['color_active'] . ' stroke-' . $config['color_active'] : 'fill-none'; ?> hover:stroke-<?php echo $config['color_active']; ?> hover:fill-<?php echo $config['color_active']; ?> focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-<?php echo $config['color_active']; ?> hover:scale-110"
                    viewBox="0 0 24 24">
                    <polygon
                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                    </polygon>
                </svg>
            </span>
        <?php endfor; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const starContainer = document.querySelector('.star-rating#<?php echo htmlspecialchars($config['id']); ?>');
            const stars = starContainer.querySelectorAll('.star');
            let currentRating = <?php echo $config['initial_rating']; ?>;

            function updateStars(rating, isHover = false) {
                stars.forEach(s => {
                    const isActive = s.getAttribute('data-rating') <= rating;
                    const svg = s.querySelector('.star-svg');
                    if (isHover) {
                        svg.classList.toggle('fill-<?php echo $config['color_active']; ?>', isActive);
                        svg.classList.toggle('stroke-<?php echo $config['color_active']; ?>', isActive);
                        svg.classList.toggle('fill-none', !isActive);
                        svg.classList.toggle('stroke-<?php echo $config['color_default']; ?>', !isActive);
                    } else {
                        s.classList.toggle('active', isActive);
                        s.setAttribute('aria-checked', isActive);
                        svg.classList.toggle('fill-<?php echo $config['color_active']; ?>', isActive);
                        svg.classList.toggle('stroke-<?php echo $config['color_active']; ?>', isActive);
                        svg.classList.toggle('fill-none', !isActive);
                        svg.classList.toggle('stroke-<?php echo $config['color_default']; ?>', !isActive);
                    }
                });
            }

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = this.getAttribute('data-rating');
                    currentRating = rating;
                    updateStars(rating);
                    <?php if (!empty($config['on_click_callback'])): ?>
                        try {
                            const callback = <?php echo $config['on_click_callback']; ?>;
                            if (typeof callback === 'function') callback(rating);
                        } catch (e) { console.error('Erro no callback:', e); }
                    <?php endif; ?>
                });

                star.addEventListener('mouseenter', function () {
                    const rating = this.getAttribute('data-rating');
                    updateStars(rating, true);
                });

                star.addEventListener('mouseleave', function () {
                    updateStars(currentRating);
                });

                star.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
/*
METODO DE USAR 

require '../components/starrating/StarRatingComponent.php';

// Função de callback (opcional)
function meuCallback($rating) {
    echo "console.log('Avaliação selecionada: ' + $rating);";
}

NA DIV Q FOR CHAMADO 

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

*/

?>