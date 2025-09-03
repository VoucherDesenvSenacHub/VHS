<?php
namespace Src\Application\Utils;

function showSweetAlert($title, $message) {
    // CDN do SweetAlert2
    $cdn = '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    // Script JavaScript para o alerta estilo toast
    $script = "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                icon: 'success', // Ícone será sempre o mesmo estilo
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
            border-image: linear-gradient(to right, #6A5AE0, #9D4DFF) 1 !important;
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
            background: #6A5AE0 !important;
            color: #fff !important;
        }
    </style>";

    return $cdn . $script;
}
?>
