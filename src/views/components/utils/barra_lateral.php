<?php
function isActive($page)
{
    return basename($_SERVER['PHP_SELF']) === $page ? 'bg-[#660BAD] bg-opacity-100 text-white' : '';
}

$menuItems = [
    'Inicio.php' => ['icon' => 'Home.svg', 'label' => 'Início'],
    'Fast.php' => ['icon' => 'Fast.svg', 'label' => 'Fast'],
    'Eventos.php' => ['icon' => 'Eventos.svg', 'label' => 'Eventos'],
    'Histórico.php' => ['icon' => 'Historico.svg', 'label' => 'Histórico'],
];

$categorias = [
    'Tecnologia.php' => ['icon' => 'Tecnologia.svg', 'label' => 'Tecnologia'],
    'Saúde.php' => ['icon' => 'Saude.svg', 'label' => 'Saúde'],
    'Moda.php' => ['icon' => 'Moda.svg', 'label' => 'Moda'],
    'Estética.php' => ['icon' => 'estetica.svg', 'label' => 'Estética'],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Barra Lateral</title>
</head>
<body class="bg-gray-950">
    <aside class="w-[9.25rem] ml-[1.87rem] h-screen">
        <h2 class="pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">HOME</h2>
        <ul>
            <?php foreach ($menuItems as $page => $data): ?>
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
                    <a href="../utils/<?= $page ?>" class="flex items-center w-full p-2">
                        <div class="icon w-[2rem] h-[2rem] flex items-center justify-center bg-[#660BAD] <?php echo isActive($page) ? 'bg-opacity-100' : 'bg-opacity-10'; ?> rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/<?= $data['icon'] ?>" alt="<?= $data['label'] ?>" class="<?php echo isActive($page) ? 'filter invert brightness-0' : ''; ?>">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold <?php echo isActive($page) ? 'text-white' : ''; ?>"> <?= $data['label'] ?> </h2>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <hr class="w-[8.06rem] mt-[1.81rem] border-gray-800">
        <h2 class="pt-[1.18rem] ml-[0.31rem] text-gray-400 text-sm font-poppins">CATEGORIA</h2>
        <ul>
            <?php foreach ($categorias as $page => $data): ?>
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
                    <a href="../utils/<?= $page ?>" class="flex items-center w-full p-2">
                        <div class="icon w-[2rem] h-[2rem] flex items-center justify-center bg-[#660BAD] <?php echo isActive($page) ? 'bg-opacity-100' : 'bg-opacity-10'; ?> rounded-[12px] ml-[0.31rem]">
                            <img src="../../../../public/icons/<?= $data['icon'] ?>" alt="<?= $data['label'] ?>" class="<?php echo isActive($page) ? 'filter invert brightness-0' : ''; ?>">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold <?php echo isActive($page) ? 'text-white' : ''; ?>"> <?= $data['label'] ?> </h2>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
</body>
</html>
