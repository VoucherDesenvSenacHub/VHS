<?php
    /*
        Exemplo de uso:

        <link rel="stylesheet" href="/VHS/src/styles/global.css">
        <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>

        require_once __DIR__ . '/index.php';
        use function Src\Views\Components\Cards\renderCards;
        renderCards($cards, 'event');
    */

    namespace Src\Views\Components\Cards;
    require_once __DIR__ . '/exampleCards.php';

    function renderCards(array $card, $type) {
        foreach ($card as $item) {
            if ($item['type_card'] === $type) {
                echo Cards::Renderer($item);
            }
        }
    }

?>

<!-- # -->

<?php

    class Cards {
        public string $type_card;
        public string $thumbnail_url;
        public string $username;
        public string $avatar_url;
        public string $title;
        public string $url;
        public string $duration;
        public string $views;
        public string $created_at;
        public string $maked_for;
        public string $description;
        public string $likes;
        public string $comments;

        public function __construct(array $card) {
            $this->thumbnail_url = htmlspecialchars($card['thumbnail_url']);
            $this->username = htmlspecialchars($card['username'] ?? '');
            $this->avatar_url = htmlspecialchars($card['avatar_url'] ?? '');
            $this->title = htmlspecialchars($card['title']);
            $this->url = htmlspecialchars($card['url']);
            $this->duration = htmlspecialchars($card['duration'] ?? 0);
            $this->views = htmlspecialchars($card['views'] ?? 0);
            $this->created_at = htmlspecialchars($card['created_at']);
            $this->type_card = htmlspecialchars($card['type_card']);
            $this->maked_for = htmlspecialchars($card['maked_for'] ?? 'Online');
            $this->description = htmlspecialchars($card['description'] ?? 'Online');
            $this->likes = htmlspecialchars($card['likes'] ?? 0);
            $this->comments = htmlspecialchars($card['comments'] ?? 0);
        }

        public static function Renderer(array $item) {
            $card = new Cards($item);

            switch ($card->type_card) {
                case 'video':
                    return $card->Video();
                case 'event':
                    return $card->Event();
                case 'channel':
                    return $card->Channel();
                case 'channels':
                    return $card->Channels();
                default:
                    return '';
            }
        }

        private function Video(): string {
            return "
                <a href='{$this->url}' class='card flex flex-col cursor-pointer relative max-w-[280px] h-[300px] 2xl:max-w-[320px] 2xl:h-[340px] bg-gray600 rounded-3xl overflow-hidden shadow-lg transition-all duration-300'>
                    <div class='relative w-full h-[50%]'>
                        <img src='{$this->thumbnail_url}' class='w-full h-full object-cover'>

                        <div class='absolute top-3 right-3 bg-black/75 px-2 py-1 rounded-md'>
                            <p class='text-white text-caption 2xl:text-paragraph'>{$this->duration}</p>
                        </div>
                    </div>

                    <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                        <p class='truncate text-gray-400 text-caption 2xl:text-paragraph pr-16'>
                            {$this->username}
                        </p>

                        <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3' style='
                         display: -webkit-box;
                         -webkit-line-clamp: 2;
                         -webkit-box-orient: vertical;
                         text-overflow: ellipsis;'
                        >
                            {$this->title}
                        </h3>

                        <p class='text-gray-400 text-caption 2xl:text-paragraph'>
                            {$this->views} views • {$this->created_at}
                        </p>
                    </div>

                    <!-- Foto do Usuário -->

                    <div class='absolute w-full h-full flex items-center justify-end p-5'>
                        <div class='relative w-16 h-16 2xl:w-20 2xl:h-20 flex items-center justify-center'>
                            <div class='absolute flex w-full h-full items-center justify-center rounded-full overflow-hidden bg-white/5'>
                                <img src='{$this->avatar_url}' class='w-full h-full object-cover'>
                            </div>
                        </div>
                    </div>
                </a>
            ";
        }

        private function Event(): string {
            return "
                <a href='{$this->url}' class='card flex cursor-pointer max-w-[280px] h-[300px] 2xl:max-w-[320px] 2xl:h-[340px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                    <div class='relative w-full h-[50%]'>
                        <img src='{$this->thumbnail_url}' class='w-full h-full object-cover'>

                        <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-caption 2xl:text-paragraph px-4 py-1 rounded-md'>
                            🔥  
                        </div>
                    </div>

                    <!-- Informações do vídeo -->

                    <div class='p-3 text-white flex flex-col justify-between h-[50%]'>
                        <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->maked_for} | {$this->description}</p>

                        <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3' style='
                         display: -webkit-box;
                         -webkit-line-clamp: 2;
                         -webkit-box-orient: vertical;
                         text-overflow: ellipsis;'>
                            {$this->title}
                        </h3>

                        <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->views} views • {$this->created_at}</p>
                    </div>
                </a>
            ";
        }

        private function Channel(): string {
            return "
                <a href='{$this->url}' class='card flex cursor-pointer max-w-[280px] h-[300px] 2xl:max-w-[320px] 2xl:h-[340px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                    <div class='relative w-full h-[50%]'>
                        <img src='{$this->thumbnail_url}' class='w-full h-full object-cover'>
                        
                        <div class='absolute top-3 right-3 bg-black bg-opacity-70 text-white text-caption px-2 py-1 rounded-md'>
                            <p class='text-white text-caption 2xl:text-paragraph'>{$this->duration}</p>
                        </div>
                    </div>

                    <!-- Informações do vídeo -->

                    <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                        <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->created_at}</p>

                        <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3' style='
                         display: -webkit-box;
                         -webkit-line-clamp: 2;
                         -webkit-box-orient: vertical;
                         text-overflow: ellipsis;'>
                            {$this->title}
                        </h3>
                        
                        <div class='flex justify-between'>
                            <div class='flex gap-2 items-center'>
                                <div>
                                    <img src='Zuias/VHS/public/icons/cards/comments.svg' class='w-full h-full'>
                                </div>
                                <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->comments}</p>
                            </div>

                            <div class='flex gap-2 items-center'>
                                <div>
                                    <img src='/VHS/public/icons/cards/stars.svg' class='w-full h-full'>
                                </div>
                                <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->likes}</p>
                            </div>

                            <div class='flex gap-2 items-center'>
                                <div>
                                    <img src='/VHS/public/icons/cards/views.svg' class='w-full h-full'>
                                </div>
                                <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->views}</p>
                            </div>
                        </div>
                    </div>
                </a>
            ";
        }

        private function Channels(): string {
            return "
                <a href='{$this->url}' class='card flex cursor-pointer max-w-[280px] h-[300px] 2xl:max-w-[320px] 2xl:h-[340px] bg-[#1B1B1B] rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300'>
                    <div class='relative w-full h-[50%]'>
                        <img src='{$this->thumbnail_url}' class='w-full h-full object-cover'>

                        <div class='absolute top-3 right-3 bg-black bg-opacity-70 px-2 py-1 rounded-md'>
                            <p class='text-white text-caption 2xl:text-paragraph'>{$this->duration}</p>
                        </div>
                    </div>

                    <!-- Informações do vídeo -->

                    <div class='p-4 text-white flex flex-col justify-between h-[50%]'>
                        <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->username}</p>

                        <h3 class='text-paragraph 2xl:text-subtitle leading-tight break-words overflow-hidden line-clamp-3' style='
                         display: -webkit-box;
                         -webkit-line-clamp: 2;
                         -webkit-box-orient: vertical;
                         text-overflow: ellipsis;'>
                            {$this->title}
                        </h3>

                        <p class='text-gray-400 text-caption 2xl:text-paragraph'>{$this->views} views • {$this->created_at}</p>
                    </div>
                </a>
            ";
        }

    }

?>