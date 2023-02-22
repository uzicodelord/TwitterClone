<?php

namespace App\Controller;

use App\BaseController;
use App\Model\TweetDisplay;

class HomeController extends BaseController
{
    public function index()
    {
        $tweetDisplay = new TweetDisplay();
        $tweets = $tweetDisplay->displayTweets();
        $this->view("Views/home.php", compact('tweets'));
    }

}
