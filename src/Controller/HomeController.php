<?php

namespace App\Controller;

use App\BaseController;
use App\Model\TweetDisplay;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $tweetDisplay = new TweetDisplay();
        $tweets = $tweetDisplay->displayTweets();
        $username = $_SESSION['username'];
        include 'Resources/views/header.twig';
        $this->view('home.twig',
            ['tweets' => $tweets,
            'username' => $username
            ]);
        include 'Resources/views/footer.twig';
    }
}
