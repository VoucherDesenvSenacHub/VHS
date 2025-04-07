
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      @theme { 
        
        --text-pop: 'Poppins', sans-serif;

        --primary: #6C00C0;
        --secondary: #fff;

        --gray-200: #C4C4C4;
        --gray-300: #666;
        --gray-600: #1B1B1B;

        --title-size: 2rem;
        --subtitle-size: 1.5rem;
        --paragraph-size: 1rem;

      }

      @layer utilities {
    .font-pop {
      font-family: var(--text-pop);
    }

    .title-size {
      font-size: var(--title-size);
    }

    .subtitle-size {
      font-size: var(--subtitle-size);
    }

    .paragraph-size {
      font-size: var(--paragraph-size);
    }
  }
    </style>
        <body class="flex items-center justify-center w-auto h-auto">
          <div class="w-64 h-auto bg-[#1b1b1b] rounded-xl">

            <div class="flex items-center w-full gap-4 h-auto p-4">
              <div class="rounded-full">
                <img class="w-12 h-12 bg-red-500 rounded-full" src="../../../../public/images/ProfilePhoto.png" alt="">
              </div>
              <div class="h-14">
                <p class="font-pop paragraph-size text-[#FFFFFF]">Freitasdev</p>
                <p class="text-[#666]">eu@freitasdev...</p>
                <p class="font-pop text-xs text-[#C4C4C4]">Desenvolvedor</p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <div>
                <img src="../../../../public/icons/Settings.svg" alt="">
              </div>
              <div class="flex flex-col gap-1">
                <p>Minha Conta</p>
                <p>Gerencie dados e preferência</p>
              </div>

            </div>
          </div>
        </body>

