<?php
    
    namespace Src\Views\Components\Utils;

    require_once __DIR__ . "../../../../application/utils/purify/index.php";

    use function Src\Application\Utils\Purify\purifyProperty;


    /**
     *  ButtonComponent - Componente para criar botões estilizados.
     * @param string $text - Texto do botão.
     * @param string $variant - Estilo do botão (outline, icon, studio, default).
     * @param string|null $icon - URL do ícone a ser exibido no botão (opcional).
     * @param float $width - Largura do botão em rem (padrão: 23.875).
     * @param float $height - Altura do botão em rem (padrão: 3.75).
     * @param float $width - Largura do botão em rem (padrão: 23.875).
     * @param float $height - Altura do botão em rem (padrão: 3.75).
     * @param string|null $id - ID do botão (opcional).
     * @param string|null $link - URL para onde o botão deve redirecionar (opcional).
     * @param bool $isActive - Indica se o botão está ativo (padrão: false).
     * @return string - HTML do botão estilizado. 
    **/
    function ButtonComponent(string $text, string $variant, string | null $icon = null, float $width = 23.875, float $height = 3.125, $id=null, string | null $link = null, bool $isActive = false, string $className = "") {
        
        $text = purifyProperty($text);
        $variant = purifyProperty($variant);
        $icon = purifyProperty($icon);
        $id = purifyProperty($id);
        $link = purifyProperty($link);
        $className = purifyProperty($className);

        $icon = $icon ? "<img src='$icon' class='w-4 h-4'>" : "";
        $width .= "rem";
        $height .= "rem";

    
        $buttonStyle = 
        "flex justify-center items-center w-[$width] h-[$height] gap-2 rounded-md cursor-pointer " 
        . ($isActive ? "text-white " : "text-[#D9D9D9] ");

        $buttonStyleOutlineDefault = 
        "flex justify-center items-center w-full h-[$height] gap-2 rounded-md cursor-pointer " 
        . ($isActive ? "text-white " : "text-[#D9D9D9] ");


        $typesButtonsStyle = [
            "outline" => $buttonStyleOutlineDefault . "outline outline-1 outline-purple-500",
            "icon" => $buttonStyle . "bg-white hover:bg-gray-300 transition-colors",
            "studio" => $buttonStyle . "bg-[#202024] transition-colors hover:bg-[#2a2a2e] !rounded-full",
            "default" => "$buttonStyleOutlineDefault bg-purple-700 transition-colors hover:bg-purple-800",
            "google" => $buttonStyle . "bg-white text-black rounded-md",
        ];

        $buttonStyle = $typesButtonsStyle[$variant] ?? $typesButtonsStyle["default"];
        $buttonStyle .= $className;

        return
            <<<HTML
                <a href='$link' class="w-full">
                    <button id='$id' class='$buttonStyle w-full'>
                    $icon
                    $text
                    </button>
                </a>
            HTML;
    }