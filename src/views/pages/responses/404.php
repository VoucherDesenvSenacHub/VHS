<?php

    http_response_code(404);

    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: no-cache, must-revalidate, max-age=0');

?>

<!-- H T M L -->

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Página não encontrada</title>

    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
</head>

<body>

    <div class="text-white flex flex-col gap-7 w-full h-screen text-center items-center justify-center">
        <div class="flex flex-row gap-2 items-center text-start">
            <h1 class="text-7xl font-bold">404</h1>
            <h2 class="text-2xl font-semibold text-white/75">Not<br>Found</h2>
        </div>

        <div class="text-xl text-white/50">
            <p>Ops — a página que você tentou acessar não existe</p>
            <p>Verifique a URL ou volte para a página inicial.</p>
        </div>

        <button class="text-xl border border-white/10 p-4 rounded-xl bg-white/10 hover:bg-primary transition-all duration-200">
            <a href="/VHS/home">Ir para a página inicial</a>
        </button>
    </div>

</body>
</html>