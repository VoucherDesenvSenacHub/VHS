<?php

namespace Src\Views\Components\Utils;

function selectCategory (
    array $categories,
    bool $error = false,
    $errorDescription = null,
    array $fields = []
) {
    
    $selectedId = $fields["category_id"] ?? "";
    $selectedName = "";

    // encontrando o nome da categoria selecionada
    foreach ($categories as $cat) {
        if ($cat["id"] == $selectedId) {
            $selectedName = "# " . $cat["name"];
            break;
        }
    }

    $jsonCategories = json_encode($categories);
    $border = empty($error) ? "border-[#666]" : "border-red-500";
    $errorMessage = $error ? $errorDescription : "";

    return <<<HTML
        <div class="relative flex flex-col w-full gap-1">
            <div class="bg-transparent flex flex-row items-center justify-around border $border rounded-md h-[45px] w-full relative">
                <input
                    type="default"
                    id="category"
                    placeholder="Escolha uma categoria"
                    value="$selectedName"
                    readonly
                    class="bg-transparent h-[45px] w-full min-w-10 text-white focus:outline-none focus:placeholder-white px-3 py-1.5"
                />
            </div>

            <div id="categoryPanel" class="hidden absolute bottom-[110%] left-0 z-10 w-full flex gap-2 bg-[#14001b]/75 backdrop-blur-md border border-[#666666] rounded-md p-2">
                <div class="flex-1 max-h-52 overflow-y-auto">
                    <div id="categoryList" class="grid grid-cols-1 gap-1" data-categories='$jsonCategories'></div>
                </div>
            </div>

            <input type="hidden" name="category_id" id="category_id_hidden" value="$selectedId"/>
            <span class="text-red-500 font-medium">$errorMessage</span>
        </div>

        <script src='/VHS/src/views/components/utils/selectCategory/script.js' defer></script>
    HTML;
}