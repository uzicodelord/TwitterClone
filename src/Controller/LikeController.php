<?php
namespace App\Controller;

use App\BaseController;
use App\Model\Likes;

class LikeController extends BaseController
{
    public function like()
    {
        $tweet = new Likes();
        $tweet->updateLikes();

    }
}