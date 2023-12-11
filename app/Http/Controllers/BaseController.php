<?php

namespace App\Http\Controllers;

use App\Services\Like\LikeService;
use App\Services\Dislike\DislikeService;

class BaseController extends Controller {

    protected $likeService;
    protected $dislikeService;

    public function __construct(LikeService $likeService, DislikeService $dislikeService){
        $this->likeService = $likeService;
        $this->dislikeService = $dislikeService;
    }
}
