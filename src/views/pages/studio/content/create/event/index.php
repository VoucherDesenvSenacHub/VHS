<?php

    require_once __DIR__ . "/../../../../../components/header/headerComponent.php";
    require_once __DIR__ . "/../../../../../components/studioSideMenu/studioSideMenuComponent.php";
    require_once __DIR__ . "/../../../../../components/utils/inputComponent.php";
    require_once __DIR__ . "/../../../../../components/utils/uploadThumbnails/index.php";
    require_once __DIR__ . "/../../../../../components/utils/selectDateTime/index.php";
    require_once __DIR__ . "/../../../../../components/utils/selectCategory/index.php";
    require_once __DIR__ . "/../../../../../components/utils/buttonComponent.php";
    require_once __DIR__ . "/../../../../../components/utils/sweetalert.php";
    require_once __DIR__ . '/../../../../../components/modal/modal.component.php';
    
    use function Src\Views\Components\Header\HeaderComponent;
    use function src\views\components\studioSideMenu\StudioSideMenuComponent;
    use function Src\Views\Components\Utils\InputComponent;
    use function Src\Views\Components\Utils\uploadThumbnails;
    use function Src\Views\Components\Utils\selectDateTime;
    use function Src\Views\Components\Utils\selectCategory;
    use function Src\Views\Components\Utils\ButtonComponent;
    use function Src\Application\Utils\showSweetAlert;
    use function Src\Views\Components\Modal\ModalComponent;

    $categories = $_SESSION["page_data"]["categories"] ?? [];
    $success = $_SESSION["redirect_data"]["success"] ?? null;

    $errors = $_SESSION["redirect_data"]["errors"] ?? null;
    $fields = $_SESSION["redirect_data"]["fields"] ?? [];

    if ($success) {
        echo ModalComponent("Criado com sucesso!", "Quer continuar criando eventos?", "/VHS/home/events", "/VHS/studio/create/event");
    }

?>

<!-- H T M L -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio - Criar Eventos</title>

    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body>
    <div class="flex flex-col min-h-screen">
        <div class="w-full h-auto fixed z-20">
            <?= HeaderComponent() ?>
        </div>

        <div class="flex flex-row w-full mt-20">
            <div class="max-lg:hidden">
                <?= StudioSideMenuComponent() ?>
            </div>
    
            <div class="flex-1 flex flex-col items-center p-10 pb-20">
                <div class="w-full max-w-[1700px] flex flex-col gap-10">
                    <div class="text-white flex flex-col gap-10">
                        <div class="flex flex-col gap-4">
                            <div class="w-full flex flex-col">
                                <h1 class="text-title font-bold">Criar Conteúdo</h1>
                                <h2 class="text-subtitle text-[#666]">Preencha os campos para criar um evento...</h2>
                            </div>
    
                            <div class="flex flex-row gap-4 w-96">
                                <?= ButtonComponent(text: "Vídeos", variant: "studio", className: "w-[10.675rem] h-[2.5rem]", link: "/VHS/studio/create/video"); ?>
                                <?= ButtonComponent(text: "Fasts", variant: "studio", className: "w-[10.675rem] h-[2.5rem]", link: "/VHS/studio/create/fast"); ?>
                                <?= ButtonComponent(text: "Eventos", variant: "studio", className: "w-[10.675rem] h-[2.5rem]", link: "/VHS/studio/create/event"); ?>
                            </div>
                        </div>
    
                        <form id="eventForm" class="flex flex-col gap-10" action="/VHS/api/v1/studio/create/event" method="POST" enctype="multipart/form-data">
                            <div class="flex flex-col gap-2">
                                <div class="w-full flex flex-col">
                                    <h3 class="text-subtitle text-white font-semibold">Link</h3>
                                    <p class="text-paragraph text-gray-400">Adicione uma url de redirecionamento</p>
                                </div>
    
                                <?= InputComponent (
                                    name: "url",
                                    type: "text",
                                    placeholder: "Escreva aqui...",
                                    error: isset($errors["url"]),
                                    errorDescription: $errors["url"] ?? "",
                                    value: $fields["url"] ?? ""
                                ) ?>
                            </div>
    
                            <div class="flex flex-col gap-2">
                                <div class="w-full flex flex-col">
                                    <h3 class="text-subtitle text-white font-semibold">Estreia</h3>
                                    <p class="text-paragraph text-gray-400">Informe a data de estreia do evento</p>
                                </div>
                                
                                <?= selectDateTime($errors["event_date"] ?? "") ?>
                            </div>
    
                            <div class="flex flex-col gap-2">
                                <div class="w-full flex flex-col">
                                    <h3 class="text-subtitle text-white font-semibold">Thumbnail</h3>
                                    <p class="text-paragraph text-gray-400">Envie a imagem que será usada como thumbnail</p>
                                </div>
                                
                                <?= uploadThumbnails (
                                    error: isset($errors["thumbnail_url"]),
                                    errorDescription: $errors["thumbnail_url"] ?? ""
                                ) ?>
                            </div>
    
                            <div class="flex flex-col gap-2">
                                <div class="w-full flex flex-col">
                                    <h3 class="text-subtitle text-white font-semibold">Título</h3>
                                    <p class="text-paragraph text-gray-400">Digite o título do conteúdo</p>
                                </div>
    
                                <?= InputComponent (
                                    name: "title",
                                    type: "text",
                                    placeholder: "Escreva aqui...",
                                    error: isset($errors["title"]),
                                    errorDescription: $errors["title"] ?? "",
                                    value: $fields["title"] ?? ""
                                ) ?>
                            </div>
    
                            <div class="flex flex-col gap-2">
                                <div class="w-full flex flex-col">
                                    <h3 class="text-subtitle text-white font-semibold">Descrição</h3>
                                    <p class="text-paragraph text-gray-400">Escreva uma breve descrição sobre o conteúdo</p>
                                </div>
    
                                <?= InputComponent (
                                    name: "description",
                                    type: "text",
                                    placeholder: "Escreva aqui...",
                                    error: isset($errors["description"]),
                                    errorDescription: $errors["description"] ?? "",
                                    value: $fields["description"] ?? ""
                                ) ?>
                            </div>
    
                            <div class="flex flex-col gap-2">
                                <div class="w-full flex flex-col">
                                    <h3 class="text-subtitle text-white font-semibold">Categorias</h3>
                                    <p class="text-paragraph text-gray-400">Selecione a categoria correspondente</p>
                                </div>
    
                                <?= selectCategory (
                                    $categories,
                                    error: isset($errors["category_id"]),
                                    errorDescription: $errors["category_id"] ?? "",
                                    fields: $fields
                                ) ?>
                            </div>
    
                            <div class="flex flex-row justify-between gap-10 mt-5">
                                <?= ButtonComponent(type: "button", text: "Cancelar", variant: "outline", id: "cancel-button", width: 27.5, link: "/VHS/studio/analytics") ?>
                                <?= ButtonComponent(type: "submit", text: "Publicar", variant: "default", id: "publish-button", width: 27.5) ?>
                            </div>
                        </form>
    
                        <?php
                            if (isset($success)) {
                                echo showSweetAlert("Sucesso ao criar o evento!", "Seu conteúdo já foi postado", "success");
                            }
    
                            if (isset($errors)) {
                                echo showSweetAlert("Erro ao criar o evento!", "Erro no preenchimento de campos", "error");
                            }
                            
                            unset($_SESSION["redirect_data"]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>