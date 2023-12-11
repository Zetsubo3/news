<?php

namespace App\Services\Dislike;

use App\Models\Dislike;
use App\Models\Like;

class DislikeService {

    public function useDislike($news_id)
    {
        // Дергаем дизлайкскаунт для новости по ньюсайди
        $existingDislike = Dislike::where('news_id', $news_id)->first();

        // Чек есть запись или это первая
        if (!$existingDislike) {
            $disLike = new Dislike();
            $disLike->news_id = $news_id; // Привязка лайка к новости
            $disLike->save();
        }

        // Инкремент каунта
        Dislike::where('news_id', $news_id)->increment('dislikes_count');
    }

    public function getDislikesCount($news_id) {
        return Dislike::where('news_id', $news_id)->count();
        //Зачем я эту пишу, кто-нибудь помогите
    }
}
