<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class DislikeController extends BaseController {
    public function index($news_id){

        $page = Request::get('page', 1); // Получаем номер текущей страницы, или дефолт если стринг пустой

        $this->dislikeService->useDislike($news_id);

        return Redirect::route('news.index', ['page' => $page, '#news_' . $news_id]);
    }
}

