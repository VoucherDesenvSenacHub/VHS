<?php
namespace Src\Application\Utils;

/**
 * Gera a paginação em HTML.
 * Como usar:
 * - $pagination = paginate($items);
 * - echo $pagination;
 * @param array $content Array de itens a serem paginados
 * @return string HTML completo da paginação
 */
function paginate($content, $limit) {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
    if ($page < 1) $page = 0;
    $prevPage = $page > 1 ? $page - 1 : 0;
    $nextPage = $page + 1;

    $buttonNext = '';
    if (count($content) == $limit) {
        $_GET['page'] = $nextPage;
        $buttonNext = <<<HTML
            <form method="GET" style="display:inline;">
                <input type="hidden" name="page" value="{$nextPage}">
        HTML;

        foreach ($_GET as $key => $value) {
            if ($key !== 'page') {
                $safeKey = htmlspecialchars($key);
                $safeVal = htmlspecialchars($value);
                $buttonNext .= "<input type='hidden' name='{$safeKey}' value='{$safeVal}'>";
            }
        }

        $buttonNext .= <<<HTML
                <button type="submit" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                    Próximo
                </button>
            </form>
        HTML;
    }

    $buttonPrev = '';
    if ($page > 0) {
        $_GET['page'] = $prevPage;
        $buttonPrev = <<<HTML
            <form method="GET" style="display:inline;">
                <input type="hidden" name="page" value="{$prevPage}">
        HTML;

        foreach ($_GET as $key => $value) {
            if ($key !== 'page') {
                $safeKey = htmlspecialchars($key);
                $safeVal = htmlspecialchars($value);
                $buttonPrev .= "<input type='hidden' name='{$safeKey}' value='{$safeVal}'>";
            }
        }

        $buttonPrev .= <<<HTML
                <button type="submit" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                    Anterior
                </button>
            </form>
        HTML;
    }

    $paginationHTML = '';
    if (!empty($content)) {
        $paginationHTML = <<<HTML
            <div class="grid grid-cols-3 items-center mt-4 text-center">
                <div class="justify-self-start">
                    {$buttonPrev}
                </div>
                <div>
                    <span class="text-slate-400">Página {$nextPage}</span>
                </div>
                <div class="justify-self-end">
                    {$buttonNext}
                </div>
            </div>
        HTML;
    }
    return $paginationHTML;
}
