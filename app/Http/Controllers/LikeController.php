<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class LikeController extends BaseController {
    public function index($news_id){
        $page = Request::get('page', 1); // Получаем номер текущей страницы

        $this->likeService->useLike($news_id);

        return Redirect::route('news.index', ['page' => $page, '#news_' . $news_id]);
    }
}
