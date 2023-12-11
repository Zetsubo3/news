<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model{
    use HasFactory;

    protected $guarded = false;
    protected $table = "news";


    public function categories(){
        return $this->belongsToMany(Category::class)->using(CategoryNews::class);
        //вот тут что-то не получилось через атач дернуть, есть вот такая странная пивот-модель
    }

    public function likes() {
        return $this->hasMany(Like::class, 'news_id');
    }

    public function dislikes() {
        return $this->hasManyThrough(Dislike::class, 'news_id');
    }
}
