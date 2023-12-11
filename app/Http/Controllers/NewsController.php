<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryNews;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class NewsController extends BaseController {
    public function index(){

        $news = News::leftJoin('likes', 'news.id', '=', 'likes.news_id')
            ->leftJoin('dislikes', 'news.id', '=', 'dislikes.news_id')
            ->selectRaw('news.*, COALESCE(SUM(likes.likes_count), 0) AS likes_count,
            COALESCE(SUM(dislikes.dislikes_count), 0) AS dislikes_count, (COALESCE(SUM(likes.likes_count), 0) - COALESCE(SUM(dislikes.dislikes_count), 0)) AS rating')
            //без функции, рейтинг отображается только после инициации лайков
            ->groupBy('news.id')
            ->orderByDesc('rating')
            ->orderByDesc('pubDate')
            ->with('categories')
            ->paginate(3);

        return view('news.index', compact('news'));
    }
}

