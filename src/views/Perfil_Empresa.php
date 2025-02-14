<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Syne:wght@400..800&display=swap" rel="stylesheet">
</head>
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center">
    <div class="p-4 sm:p-6 md:p-8 mt-25 ml-25 sm:mt-50 sm:ml-50 ">
        <div class="relative w-4/5 h-60 overflow-hidden z-0">
            <!-- Imagem maior -->
            <img src="../../public/logos/B&W.jpg" class="absolute right-0 h-full w-full object-cover" alt="Grande">
        </div>
        
        <div class="absolute left-70 top-95 w-40 h-40 rounded-[20%] border border-white/20 overflow-hidden z-10">
            <img src="../../public/logos/BillGates.webp" class="w-full h-full object-cover" alt="Pequena">
        </div>
        <div>
            <h1 class="text-white ml-55 bold text-[30px] font-[Poppins] mb-0">Microsoft</h1>
            <div class="flex">
            <p class="p-0 mt-0 text-gray-200 ml-55 bold text-[15px] font-[Poppins]">4.5k de seguidores</p>
            <p class="p-0 mt-0 ml-1 text-gray-200 bold text-[15px] font-[Poppins]">|</p>
            <p class="p-0 mt-0 ml-1 text-white bold text-[15px] font-[Poppins]">Parceiro</p>
            <button class="w-[160px] bg-none text-white px-4 py-2 rounded-md border border-violet-500">Seguir</button>
            </div>
        </div>
    </div>
    
</body>
</html>