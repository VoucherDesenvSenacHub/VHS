  <?php 
  session_start();
  require "../../../../infra/models/user.php";
  use Src\Infra\Models\UserModel;
  
  require "../../../../infra/models/comment.php";
  use Src\Infra\Models\CommentModel;
  
  $userModel = new UserModel();
  $user_id = $userModel->findUserByEmail('jaofelipes22@gmail.com')[0]['id'];
  $video_id = 2;
  
  $commentModel = new CommentModel();
  $comments = $commentModel->getCommentsByVideoId($video_id);

  require "../../../components/header/headerComponent.php";
  require "../../../components/sidebar/SidebarComponent.php";
  require "../../../components/cards/index.php";
  require "../../../components/utils/comments/comentaryComponent.php";
  require "../../../components/starrating/StarRatingComponent.php";
  require "../../../components/shared/shared.php";
  require "../../../components/utils/textareaComponent.php";
  require "../../../components/utils/buttonComponent.php";

  use function Src\Views\Components\Header\HeaderComponent;
  use function Src\Views\Components\Sidebar\SidebarComponent;
  use function Src\Views\Components\Cards\renderCards;
  use function Src\Views\Components\Utils\Comment;
  use function Src\Views\Components\starrating\StarRatingComponent;
  use function Src\Views\Components\Shared\sharedComponent;
  use function Src\Views\Components\Utils\TextareaComponent;
  use function Src\Views\Components\Utils\ButtonComponent;

  $link = 'https://www.youtube.com/embed/Qjk-cSW-jk4?si=D_1dC9a8td9k1VnJ';
  $title = 'Entendendo Back-End para Iniciantes em Programação (Parte 1) | Série "Começando aos 40';
  $subtitle = 'Este é o 5o episódio da série "Começando aos 40". Você deve assistir os episódios anteriores da série pra entender onde estamos e recomendo assistir os 2 vídeos da série "Sua Linguagem Não É Especial". No episódio de hoje vou começar a introduzir os conceitos básicos para o que chamamos de "back-end", que na prática é a própria introdução à programação.';

  $cards = [
      [
          "type_card" => "video",
          "title" => "Como aprender programação do zero e se tornar um excelente desenvolvedor full stack",
          "duration" => "7 min",
          "username" => "Rafael Germinari",
          "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
          "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
          "views" => "53k",
          "created_at" => "há 2 dias",
          "url" => "#"
      ],
  ];

  ?>

  <!DOCTYPE html>
  <html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <title>VHS - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
  </head>
  <body class="bg-gradient-to-b from-[#20002c] to-black text-white">


    <header class="w-full">
      <?= HeaderComponent() ?>
    </header>

    <div class="flex">

      <aside class="w-[240px]">
        <?= SidebarComponent() ?>
      </aside>

      <main class="flex-1 p-4 max-w-[1500px] m-auto">

        <div class="w-full">
          <div class="rounded-lg">
            <iframe
              class="w-full md:h-[40rem] rounded-lg"
              src="<?= $link ?>"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen
            ></iframe>
          </div>
          <div class="flex gap-[23rem]">
              <div class="">
                  <h2 class="mt-4 text-xl font-semibold"><?= $title ?></h2>
                  <p class="mt-2 text-sm text-gray-300 whitespace-pre-line"><?= $subtitle ?></p>
              </div>
              <div class="mt-5 flex">
                  <img class="w-6 h-6 mr-3 cursor-pointer" src="/VHS/public/icons/Share.svg" alt="ShareButton" onclick="openShared()" name="send">
                  <?= sharedComponent('https://www.youtube.com/watch?v=Qjk-cSW-jk4','Sla')?>
                  <?= StarRatingComponent() ?>
              </div>
          </div>
    <!-- Parte do canal temporaria até ter o componente para trocar  -->
          <a href="/VHS/src/views/pages/home/channel" class="flex items-center mt-10 gap-3">
            <img src="https://yt3.googleusercontent.com/ytc/AIdro_l9jtAcERHIts0q6LsUtmAGPzQ8p8FzKGAoYRJ1N3Wz3Hs0=s160-c-k-c0x00ffffff-no-rj" alt="Autor" class="w-[67px] h-[68px] rounded-xl">
            <div>
              <p class="text-sm font-bold">Fabio Akita</p>
              <p class="text-xs text-gray-400">260 mil seguidores</p>
              <button class="bg-gray-900 text-gray-300 font-bold py-1 px-2 rounded-full hover:bg-gray-800 text-[10px] mt-1">#Tecnologia</button>
            </div>
          </a>
        </div>
    <!-- Parte do canal temporaria até ter o componente certo para trocar  -->
        <div class="flex flex-col lg:flex-row gap-6 mt-8">

          <div class="w-full lg:flex-[2] rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Recomendados</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              <?php for ($i = 0; $i < 6; $i++) {
                renderCards($cards, 'video');
              } ?>
            </div>
          </div>

          <div class="w-full lg:flex-1 bg-[#1B1B1B] p-4 rounded-lg mt-10">
            <div class="flex mb-4">
              <div class="bg-blue size-16  rounded-full mt-3 mr-4 #1B1B1Bshrink-0">
                <img src="https://img.freepik.com/vetores-gratis/circulo-azul-com-usuario-branco_78370-4707.jpg?semt=ais_items_boosted&w=740" alt="" class=" rounded-full mt-1 object-cover">  
              </div>
              <form onsubmit="" onreset="resetTextareaHeight(this)" class="flex flex-col w-full mt-2" action="/VHS/src/application/routes/route.php/api/v1/home/video/" method="POST">
      
      <!-- Campo de texto -->
                <?= TextareaComponent(
                  placeholder: "Adicionar comentário...",
                  type: "text",
                  multiline: true,
                  height: "42",
                  name:"content",
                  ) ?>
              

                  
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
                <input type="hidden" name="video_id" value="<?= htmlspecialchars($video_id) ?>">

                <div class="w-2/3 self-end mt-2 flex gap-4 ">
                    <?= ButtonComponent('Cancelar', 'outline', null,1, 2.18, type:'reset') ?>
                    <?= ButtonComponent('Enviar', 'default', null,1, 2.18) ?>

                </div>
            </form>
            </div>
           
              <h3 class="text-lg font-semibold mb-4 ml-2 "><?= count($comments) ?> Comentários</h3>

            <?php 
            
            if (!empty($comments)) {
              foreach ($comments as $comment) {
                  echo Comment(
                      $comment['name'],
                      $comment['content'],
                      date('d/m/Y H:i', strtotime($comment['created_at'])),
                      $comment['avatar_url']
                  );
              }
          } else {
              echo "<p class='text-gray-400 text-sm'>Nenhum comentário ainda. Seja o primeiro!</p>";
          } ?>
          </div>

        </div>

      </main>
    </div>
    <script src='/VHS/src/views/pages/home/video/script.js'></script>
  </body>
  </html>




