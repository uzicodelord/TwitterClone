<?php

namespace App\Controller;

use App\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $deleteTweet = new TweetController();
        $deleteTweet->delete();

        $like = new TweetController();
        $like->like();

        $comment = new CommentController();
        $comment->create();

        $create = new TweetController();
        $create->create();

        $search = new TweetController();
        $search->search();

        $display = new TweetController();
        $display->display();

    }
}
