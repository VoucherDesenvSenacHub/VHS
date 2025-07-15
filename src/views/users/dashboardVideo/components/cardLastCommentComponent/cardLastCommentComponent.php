<?php
function CardLatestCommentComponent(array $videos)
{
    $totalComments = array_sum(array_column($videos, 'commentNumber'));

    $html = "
        <div class='bg-[#1B1B1B] p-6 w-full max-w-lg min-h-[32rem] min-w-[24rem] max-h-[90vh] rounded-xl border border-gray-700 space-y-2'>
            <div class='flex items-center justify-between w-full'>
                <text class='font-sans text-2xl font-bold text-white cursor-default'>Últimos Comentários</text>
                <a href='#' class='text-sm font-medium text-zinc-400 hover:text-white transition-all duration-300 bg-zinc-700/50 rounded-full w-36 flex items-center justify-center px-3 py-[3px]'>$totalComments comentários</a>
            </div>
            <div class='h-88'>
    ";

    foreach ($videos as $video) {
        $name = htmlspecialchars($video['name']);
        $commentNumber = htmlspecialchars($video['commentNumber']);
        $description = htmlspecialchars($video['description']);
        $profile = htmlspecialchars($video['profile']);
        $amountDay = htmlspecialchars($video['amountDay']);
        $amountLike = htmlspecialchars($video['amountLike']);
        $amountResponses = htmlspecialchars($video['amountResponses']);
        $html .= "
                <div class='flex gap-4 justify-start hover:bg-zinc-800/50 p-2 transition-all duration-300 rounded-lg'>
                    <div class='flex flex-col justify-between'>
                        <div class='flex flex-col gap-1'>
                            <div class='flex gap-2 h-24'>
                                <div class='flex justify-start gap-1'>
                                    <div class='w-14 h-full rounded-full overflow-hidden'>
                                        <img class='w-full h-14 rounded-full object-cover transition duration-700' src='$profile' alt='$name'>
                                    </div>
                                </div>
                                <div class='flex flex-col w-full gap-1'>
                                    <div class='flex gap-2'>
                                        <h2 class='font-medium text-white text-sm line-clamp-2'>$name</h2>
                                        <time class='text-slate-400 text-xs'>há $amountDay dias</time>
                                    </div>
                                    <p class='text-xs text-zinc-400 mb-2'>$description</p>
                                    <div class='mt-1 flex gap-1'>
                                        <div class='flex items-center gap-1 hover:bg-zinc-700/50 transition-all duration-200 rounded-lg p-1'>
                                            <img class='w-4 h-4' src='../../../../public/icons/heart.svg' alt=''>
                                            <span class='text-xs text-zinc-400'>$amountLike</span>
                                        </div>
                                        <div class='flex items-center gap-1 hover:bg-zinc-700/50 transition-all duration-200 rounded-lg p-1'>
                                            <img class='w-4 h-4' src='../../../../public/icons/reply.svg' alt=''>
                                            <span class='text-xs text-zinc-400'>$amountResponses respostas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        ";
    }

    $html .= "
            </div>
        </div>
    ";

    return $html;
}
