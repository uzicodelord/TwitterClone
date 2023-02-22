<?php

namespace App\Controller;

use App\BaseController;
use App\Model\TweetDisplay;

class ViewuserController extends BaseController
{
    public function index()
    {
        $tweetDisplay = new TweetDisplay();
        $tweets = $tweetDisplay->displayTweets();
        $this->view("Views/viewuser.php", compact('tweets'));
    }

}
