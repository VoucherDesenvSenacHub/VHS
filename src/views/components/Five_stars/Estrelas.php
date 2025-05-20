<?php
namespace src\views\components\starrating;

// Função que cria um componente de classificação por estrelas
// Parâmetro $id define um identificador único para o componente (padrão: 'star-rating')
function StarRatingComponent($id = 'star-rating') {
    // Inicia o buffer de saída para capturar o conteúdo gerado
    ob_start();
    ?>
    <!-- Div principal do componente de classificação por estrelas -->
    <div class="star-rating" id="<?php echo htmlspecialchars($id); ?>">
        <?php
        // Loop para criar 5 estrelas
        for ($i = 1; $i <= 5; $i++) {
            ?>
            <!-- Cada estrela é um elemento span com um atributo data-rating -->
            <span class="star" data-rating="<?php echo $i; ?>">
                <!-- Ícone SVG de uma estrela -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="star-svg">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            </span>
            <?php
        }
        ?>
    </div>

    <!-- Estilos CSS para o componente -->
    <style>
        /* Estiliza o contêiner das estrelas */
        .star-rating#<?php echo htmlspecialchars($id); ?> {
            display: inline-flex; /* Exibe as estrelas em linha */
            gap: 5px; /* Espaçamento entre as estrelas */
            width: 100%; /* Ocupa toda a largura disponível */
            justify-content: flex-end; /* Alinha as estrelas à direita */
        }

        /* Estiliza cada estrela individual */
        .star-rating#<?php echo htmlspecialchars($id); ?> .star {
            cursor: pointer; /* Cursor de ponteiro ao passar o mouse */
            transition: all 0.2s ease; /* Transição suave para animações */
        }

        /* Estiliza o ícone SVG da estrela */
        .star-rating#<?php echo htmlspecialchars($id); ?> .star-svg {
            stroke: #ccc; /* Cor da borda padrão */
            stroke-width: 2; /* Espessura da borda */
            fill: none; /* Sem preenchimento por padrão */
        }

        /* Estiliza a estrela quando o mouse passa por cima ou quando está ativa */
        .star-rating#<?php echo htmlspecialchars($id); ?> .star:hover .star-svg,
        .star-rating#<?php echo htmlspecialchars($id); ?> .star.active .star-svg {
            stroke: #660BAD; /* Cor da borda roxa */
            fill: #660BAD; /* Preenchimento roxo */
        }

        /* Aumenta a estrela ao passar o mouse */
        .star-rating#<?php echo htmlspecialchars($id); ?> .star:hover {
            transform: scale(1.1); /* Escala a estrela em 10% */
        }
    </style>

    <!-- Script JavaScript para interatividade -->
    <script>
    // Aguarda o carregamento completo do DOM
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona todas as estrelas dentro do componente com o ID específico
        const stars = document.querySelectorAll('.star-rating#<?php echo htmlspecialchars($id); ?> .star');
        
        // Adiciona um evento de clique para cada estrela
        stars.forEach(star => {
            star.addEventListener('click', function() {
                // Obtém o valor de classificação (data-rating) da estrela clicada
                const rating = this.getAttribute('data-rating');
                
                // Itera sobre todas as estrelas
                stars.forEach(s => {
                    // Ativa estrelas com valor de classificação menor ou igual ao clicado
                    if (s.getAttribute('data-rating') <= rating) {
                        s.classList.add('active');
                    } else {
                        // Desativa as demais estrelas
                        s.classList.remove('active');
                    }
                });
            });
        });
    });
    </script>
    <?php
    // Retorna o conteúdo capturado pelo buffer de saída
    return ob_get_clean();
}
?>