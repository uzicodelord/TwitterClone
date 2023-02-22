<?php

namespace App\Controller;

use App\BaseController;
use App\Model\TweetDisplay;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = $_SESSION['username'];
        $tweetDisplay = new TweetDisplay();
        $tweets = $tweetDisplay->displayTweetsForUser($user);
            $this->view("Views/profile.php", compact('tweets'));
    }
}
