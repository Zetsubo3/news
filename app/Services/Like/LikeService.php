<?php

namespace App\Services\Like;

use App\Models\Dislike;
use App\Models\Like;

class LikeService {

    public function useLike($news_id)
    {
        // Дергаем лайкскаунт для новости по ньюсайди
        $existingLike = Like::where('news_id', $news_id)->first();

        // Чек есть запись или это первая
        if (!$existingLike) {
            $like = new Like();
            $like->news_id = $news_id; // Привязка лайка к новости
            $like->save();
        }

        // Инкремент каунта
        Like::where('news_id', $news_id)->increment('likes_count');
    }

    public function getLikesCount($news_id) {
        return Like::where('news_id', $news_id)->count();
    }
}
