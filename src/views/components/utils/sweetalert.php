<?php
namespace Src\Application\Utils;

function showSweetAlert($title, $message, $type) {
    // Valida o tipo para garantir que seja 'success' ou 'error'
    $icon = ($type === 'error') ? 'error' : 'success';
    
    // Define cores diferentes para sucesso e erro
    $iconColor = ($type === 'success') ? '#28a745' : '#dc3545'; // Verde para sucesso, vermelho para erro
    $borderGradient = ($type === 'success') 
        ? 'linear-gradient(to right, #28a745, #20c997)' // Gradiente verde para sucesso
        : 'linear-gradient(to right, #dc3545, #c82333)'; // Gradiente vermelho para erro

    // CDN do SweetAlert2
    $cdn = '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    // Script JavaScript para o alerta estilo toast
    $script = "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                icon: '$icon', // Ícone dinâmico: 'success' (✓) ou 'error' (x)
                title: '$title',
                text: '$message',
                position: 'bottom-end', // canto inferior direito
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal-custom',
                    title: 'swal-title',
                    htmlContainer: 'swal-text',
                    icon: 'swal-icon'
                }
            });
        });
    </script>
    <style>
        .swal-custom {
            background: #1E1E1E !important;
            color: #fff !important;
            border-radius: 12px !important;
            padding: 15px 20px !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4) !important;
            font-family: 'Inter', sans-serif !important;
            border-bottom: 3px solid;
            border-image: $borderGradient 1 !important;
        }
        .swal-title {
            font-size: 16px !important;
            font-weight: 600 !important;
            color: #fff !important;
        }
        .swal-text {
            font-size: 14px !important;
            margin-top: 4px !important;
            color: #bbb !important;
        }
        .swal-icon {
            border-radius: 50% !important;
            background: $iconColor !important;
            color: #fff !important;
        }
    </style>";

    return $cdn . $script;
}
?>