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
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        include 'Resources/views/header.twig';
        $this->view('profile.twig',
            ['tweets' => $tweets, 'username' => $username, 'email' => $email]);
        include 'Resources/views/footer.twig';
    }
}
