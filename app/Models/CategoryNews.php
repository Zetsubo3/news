<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryNews extends Pivot
{
    use HasFactory;
    protected $guarded = false;
    protected $table = "category_news";


}
