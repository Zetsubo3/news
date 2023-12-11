<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'NewsController@index') ->name('news.index'); //Получение полного списка
//лучше использовать однометодные, но он и так один)

Route::post('/like{news_id}', 'LikeController@index') ->name('like.index'); //обработка сабжа
Route::post('/dislike{news_id}', 'DisLikeController@index') ->name('dislike.index');




